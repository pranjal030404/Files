<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Constants\Status;
use App\Lib\Intended;
use App\Lib\FirebaseAuthVerifier;

class AuthorizationController extends Controller
{
    protected function checkCodeValidity($user,$addMin = 2)
    {
        if (!$user->ver_code_send_at){
            return false;
        }
        if ($user->ver_code_send_at->addMinutes($addMin) < Carbon::now()) {
            return false;
        }
        return true;
    }

    protected function smsIsFirebase()
    {
        return @gs('sms_config')->name === 'firebase';
    }

    public function authorizeForm()
    {
        $user = auth()->user();

        if (!$user->status) {
            $pageTitle = 'Banned';
            $type = 'ban';
        }elseif(!$user->ev) {
            $type = 'email';
            $pageTitle = 'Verify Email';
            $notifyTemplate = 'EVER_CODE';
        }elseif (!$user->sv) {
            $type = 'sms';
            $pageTitle = 'Verify Mobile Number';
            $notifyTemplate = 'SVER_CODE';
        }else{
            return to_route('user.home');
        }

        if (!$this->checkCodeValidity($user) && ($type != 'ban') && !($type == 'sms' && $this->smsIsFirebase())) {
            $user->ver_code = verificationCode(6);
            $user->ver_code_send_at = Carbon::now();
            $user->save();
            notify($user, $notifyTemplate, [
                'code' => $user->ver_code
            ],[$type]);
        }

        return view('Template::user.auth.authorization.'.$type, compact('user', 'pageTitle'));

    }

    public function sendVerifyCode($type)
    {
        $user = auth()->user();

        if ($this->checkCodeValidity($user)) {
            $targetTime = $user->ver_code_send_at->addMinutes(2)->timestamp;
            $delay = $targetTime - time();
            throw ValidationException::withMessages(['resend' => 'Please try after ' . $delay . ' seconds']);
        }

        if ($type == 'email') {
            $type = 'email';
            $notifyTemplate = 'EVER_CODE';
        } else {
            $type = 'sms';
            $notifyTemplate = 'SVER_CODE';
        }

        if ($type == 'sms' && $this->smsIsFirebase()) {
            $notify[] = ['success', 'Verification code sent successfully'];
            return back()->withNotify($notify);
        }

        $user->ver_code = verificationCode(6);
        $user->ver_code_send_at = Carbon::now();
        $user->save();

        notify($user, $notifyTemplate, [
            'code' => $user->ver_code
        ],[$type]);

        $notify[] = ['success', 'Verification code sent successfully'];
        return back()->withNotify($notify);
    }

    public function emailVerification(Request $request)
    {
        $request->validate([
            'code'=>'required'
        ]);

        $user = auth()->user();

        if ($user->ver_code == $request->code) {
            $user->ev = Status::VERIFIED;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();

            $redirection = Intended::getRedirection();
            return $redirection ? $redirection : to_route('user.home');
        }
        throw ValidationException::withMessages(['code' => 'Verification code didn\'t match!']);
    }

    public function mobileVerification(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);


        $user = auth()->user();
        if ($user->ver_code == $request->code) {
            $user->sv = Status::VERIFIED;
            $user->ver_code = null;
            $user->ver_code_send_at = null;
            $user->save();
            $redirection = Intended::getRedirection();
            return $redirection ? $redirection : to_route('user.home');
        }
        throw ValidationException::withMessages(['code' => 'Verification code didn\'t match!']);
    }

    public function mobileVerificationFirebase(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        $user = auth()->user();

        try {
            $claims = FirebaseAuthVerifier::verify($request->id_token, gs('sms_config')->firebase->project_id);
        } catch (\Exception $e) {
            throw ValidationException::withMessages(['code' => 'Verification failed: ' . $e->getMessage()]);
        }

        $phone = ltrim($claims['phone_number'], '+');
        if ($phone !== $user->mobileNumber) {
            throw ValidationException::withMessages(['code' => 'Verified phone number does not match your account.']);
        }

        $user->sv = Status::VERIFIED;
        $user->ver_code = null;
        $user->ver_code_send_at = null;
        $user->save();

        $redirection = Intended::getRedirection();
        return $redirection ? $redirection : to_route('user.home');
    }

    public function g2faVerification(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'code' => 'required',
        ]);
        $response = verifyG2fa($user,$request->code);
        if ($response) {
            $redirection = Intended::getRedirection();
            return $redirection ? $redirection : to_route('user.home');
        }else{
            $notify[] = ['error','Wrong verification code'];
            return back()->withNotify($notify);
        }
    }
}
