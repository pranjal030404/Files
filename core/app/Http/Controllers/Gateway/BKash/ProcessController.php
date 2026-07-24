<?php

namespace App\Http\Controllers\Gateway\BKash;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Deposit;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcessController extends Controller {

    private static $username;
    private static $password;
    private static $appKey;
    private static $appSecret;

    // private static $sandbox = 1;
    // private static $baseUrl = "https://tokenized.sandbox.bka.sh/v1.2.0-beta"; // Sandbox URL

    private static $sandbox = 0;
    private static $baseUrl = "https://tokenized.pay.bka.sh/v1.2.0-beta"; // Production URL


    public static function process($deposit) {
        $account = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        self::$username = $account->username;
        self::$password = $account->password;
        self::$appKey = $account->app_key;
        self::$appSecret = $account->app_secret;

        $header = self::authHeaders();
        $alias = $deposit->gateway->alias;
        $bodyData = [
            'mode' => '0011',
            'payerReference' => $deposit->trx,
            'callbackURL' => route('ipn.' . $alias),
            'amount' => round($deposit->final_amount, 2),
            'currency' => $deposit->gatewayCurrency()->currency,
            'intent' => 'sale',
            'merchantInvoiceNumber' => $deposit->trx,
        ];

        $response = CurlRequest::curlPostContent(self::$baseUrl . '/tokenized/checkout/create', json_encode($bodyData), $header);
        $response = json_decode($response);

        if (isset($response->bkashURL)) {

            $deposit->btc_wallet = isset($response->paymentID) ? $response->paymentID : '';
            $deposit->save();

            $send['redirect']     = true;
            $send['redirect_url'] = $response->bkashURL;
            return json_encode($send);
        }

        $send['error'] = true;
        $send['message'] = "Error: " . $response->message ?? 'An unexpected error occurred. Please try again.';
        return json_encode($send);
    }


    public function ipn(Request $request) {
        if ($request->status && $request->status == 'success') {
            $deposit = Deposit::where('btc_wallet', $request->paymentID)->first();

            $account = json_decode($deposit->gatewayCurrency()->gateway_parameter);

            self::$username = $account->username;
            self::$password = $account->password;
            self::$appKey = $account->app_key;
            self::$appSecret = $account->app_secret;

            $response = $this->executePayment($request->paymentID);

            if (is_null($response)) {
                sleep(1);
                $response = $this->queryPayment($request->paymentID);
            }

            $response = json_decode($response);

            if (isset($response->statusCode) && $response->statusCode == '0000' && isset($response->transactionStatus) && $response->transactionStatus == 'Completed') {
                PaymentController::userDataUpdate($deposit);

                $notify[] = ['success', 'Transaction was successful'];
                return redirect($deposit->success_url)->withNotify($notify);
            } else {
                $notify[] = ['error', 'Payment failed'];
                return redirect($deposit->failed_url)->withNotify($notify);
            }
        }
        $notify[] = ['error', 'Payment failed'];
        return to_route('user.deposit.index')->withNotify($notify);
    }

    public function queryPayment($paymentID) {
        return CurlRequest::curlPostContent(self::$baseUrl . '/tokenized/checkout/payment/status', json_encode(['paymentID' => $paymentID]), self::authHeaders());
    }

    public function executePayment($paymentID) {
        return CurlRequest::curlPostContent(self::$baseUrl . '/tokenized/checkout/execute', json_encode(['paymentID' => $paymentID]), self::authHeaders());
    }

    private static function grant() {
        $sandbox = self::$sandbox;
        self::createTokenTable();

        $tokenData = DB::table('bkash_token')->where('sandbox_mode', $sandbox)->first();

        if (!$tokenData) {
            throw new \Exception("bkash_token table doesn't contains the token");
        }

        $idToken = $tokenData->id_token;

        if ($tokenData->id_expiry > time()) {
            return $idToken;
        }

        if ($tokenData->refresh_expiry > time()) {
            $idToken = self::getIdTokenFromRefreshToken($tokenData->refresh_token);
            DB::table('bkash_token')->where('sandbox_mode', $sandbox)
                ->update([
                    'id_expiry' => time() + 3600, // Set new expiry time
                    'id_token' => $idToken,
                ]);
            return $idToken;
        }

        $header = [
            'Content-Type:application/json',
            'username:' . self::$username,
            'password:' . self::$password
        ];

        $bodyData = [
            'app_key' => self::$appKey,
            'app_secret' => self::$appSecret
        ];

        $response = CurlRequest::curlPostContent(self::$baseUrl . '/tokenized/checkout/token/grant', json_encode($bodyData), $header);
        $response = json_decode($response);

        if (isset($response->id_token) && $response->id_token) {
            $idToken = $response->id_token;
            DB::table('bkash_token')->where('sandbox_mode', $sandbox)
                ->update([
                    'id_expiry' => time() + 3600, // Set new expiry time
                    'id_token' => $idToken,
                    'refresh_expiry' => time() + 864000,
                    'refresh_token' => $response->refresh_token,
                ]);
        }

        return $idToken;
    }

    private static function createTokenTable() {

        if (Schema::hasTable('bkash_token')) {
            return;
        }

        Schema::create('bkash_token', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sandbox_mode')->notNullable();
            $table->bigInteger('id_expiry')->default(0)->notNullable();
            $table->string('id_token', 2048)->notNullable();
            $table->bigInteger('refresh_expiry')->default(0)->notNullable();
            $table->string('refresh_token', 2048)->notNullable();
            $table->timestamps();
        });

        DB::table('bkash_token')->insert([
            [
                'sandbox_mode' => 1,
                'id_expiry' => 0,
                'id_token' => 'sandbox_id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'sandbox_refresh_token',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sandbox_mode' => 0,
                'id_expiry' => 0,
                'id_token' => 'live_id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'live_refresh_token',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    private static function getIdTokenFromRefreshToken($refreshToken) {
        try {
            $header = [
                'Content-Type: application/json',
                'username: ' . self::$username,
                'password: ' . self::$password
            ];

            $bodyData = [
                'app_key' => self::$appKey,
                'app_secret' => self::$appSecret,
                'refresh_token' => $refreshToken
            ];

            $url = self::$baseUrl . '/tokenized/checkout/token/refresh';

            $response = CurlRequest::curlPostContent($url, json_encode($bodyData), $header);

            if (!$response) {
                throw new \Exception("Error: Empty response from API.");
            }

            $response = json_decode($response);

            if (!isset($response->id_token)) {
                throw new \Exception("Error: `id_token` not found in response.");
            }

            return $response->id_token;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private static function authHeaders() {
        return [
            'Content-Type:application/json',
            'Authorization:' . self::grant(),
            'X-APP-Key:' . self::$appKey,
        ];
    }
}
