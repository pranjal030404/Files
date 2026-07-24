<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\GoogleAuthenticator;
use App\Models\BasicInfo;
use App\Models\BloodGroup;
use App\Models\CareerInfo;
use App\Models\DeviceToken;
use App\Models\EducationInfo;
use App\Models\FamilyInfo;
use App\Models\Form;
use App\Models\MaritalStatus;
use App\Models\PartnerExpectation;
use App\Models\PhysicalAttribute;
use App\Models\PurchaseHistory;
use App\Models\ReligionInfo;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller {
    public function home() {
        $pageTitle = 'Dashboard';
        $user      = User::where('id', auth()->id())->with(['limitation.package', 'interests' => function ($query) {
            $query->orderBy('id', 'desc')->take(10);
        }, 'interests.profile.basicInfo', 'interests.conversation', 'interestRequests' => function ($query) {
            $query->orderBy('id', 'desc')->take(10);
        }, 'interestRequests.user.basicInfo', 'interestRequests.conversation'])
            ->withCount([
                'galleries as total_images', 'shortListedProfile as totalShortlisted',
                'interests as interestSent', 'interestRequests as totalInterestRequests',
            ])->first();

        return view('Template::user.dashboard', compact('pageTitle', 'user'));
    }

    public function purchaseHistory() {
        $pageTitle         = 'Package Purchase History';
        $purchasedPackages = PurchaseHistory::where('status', '!=', Status::PAYMENT_INITIATE)
            ->where('user_id', auth()->id())->searchable(['package:name'])
            ->with(['deposit', 'deposit.gateway:code,name'])
            ->orderby('id', 'desc')->paginate(getPaginate());

        return view('Template::user.purchase_history', compact('pageTitle', 'purchasedPackages'));
    }

    public function depositHistory(Request $request) {
        $pageTitle = 'Deposit History';
        $deposits  = auth()->user()->deposits()->searchable(['trx'])->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function show2faForm() {
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . gs('site_name'), $secret);
        $pageTitle = '2FA Security';
        return view('Template::user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request) {
        $user = auth()->user();
        $request->validate([
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = Status::ENABLE;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request) {
        $request->validate([
            'code' => 'required',
        ]);

        $user     = auth()->user();
        $response = verifyG2fa($user, $request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts  = Status::DISABLE;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function transactions() {
        $pageTitle = 'Transactions';
        $remarks   = Transaction::distinct('remark')->orderBy('remark')->get('remark');

        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view('Template::user.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function kycForm() {
        if (auth()->user()->kv == Status::KYC_PENDING) {
            $notify[] = ['error', 'Your KYC is under review'];
            return to_route('user.home')->withNotify($notify);
        }
        if (auth()->user()->kv == Status::KYC_VERIFIED) {
            $notify[] = ['error', 'You are already KYC verified'];
            return to_route('user.home')->withNotify($notify);
        }
        $pageTitle = 'KYC Form';
        $form      = Form::where('act', 'kyc')->first();
        return view('Template::user.kyc.form', compact('pageTitle', 'form'));
    }

    public function kycData() {
        $user      = auth()->user();
        $pageTitle = 'KYC Data';
        abort_if($user->kv == Status::VERIFIED, 403);

        return view('Template::user.kyc.info', compact('pageTitle', 'user'));
    }

    public function kycSubmit(Request $request) {
        $form           = Form::where('act', 'kyc')->firstOrFail();
        $formData       = $form->form_data;
        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $user = auth()->user();
        foreach (@$user->kyc_data ?? [] as $kycData) {
            if ($kycData->type == 'file') {
                fileManager()->removeFile(getFilePath('verify') . '/' . $kycData->value);
            }
        }
        $userData                   = $formProcessor->processFormData($request, $formData);
        $user->kyc_data             = $userData;
        $user->kyc_rejection_reason = null;
        $user->kv                   = Status::KYC_PENDING;
        $user->save();

        $notify[] = ['success', 'KYC data submitted successfully'];
        return to_route('user.home')->withNotify($notify);
    }

    public function userData() {
        $user = auth()->user();
        if ($user->profile_complete == Status::YES) {
            return to_route('user.home');
        }

        $totalStep = count($user->completed_step) + count($user->skipped_step);
        $data      = [];
        if (!$totalStep) {
            $pageTitle               = 'Basic Information';
            $data['religions']       = ReligionInfo::get();
            $data['maritalStatuses'] = MaritalStatus::get();
            $data['countries']       = json_decode(file_get_contents(resource_path('views/partials/country.json')));
            $data['user']            = $user;
            $info                    = json_decode(json_encode(getIpInfo()), true);
            $data['mobileCode']      = @implode(',', $info['code']);

            $view = 'user.information.basic';
        } else if ($totalStep == 1) {
            $pageTitle = 'Family Information';
            $view      = 'user.information.family';
        } else if ($totalStep == 2) {
            $pageTitle = 'Education Information';
            $view      = 'user.information.education';
        } else if ($totalStep == 3) {
            $pageTitle = 'Career Information';
            $view      = 'user.information.career';
        } else if ($totalStep == 4) {
            $pageTitle           = 'Physical Attributes';
            $data['bloodGroups'] = BloodGroup::get();
            $view                = 'user.information.physical_attributes';
        } else if ($totalStep == 5) {
            $pageTitle               = 'Partner Expectation';
            $data['countries']       = json_decode(file_get_contents(resource_path('views/partials/country.json')));
            $data['maritalStatuses'] = MaritalStatus::get();
            $data['religions']       = ReligionInfo::get();
            $view                    = 'user.information.partner_expectation';
        }

        $data['pageTitle'] = $pageTitle;
        return view("Template::$view", $data);
    }

    public function userDataSubmit(Request $request, $step) {
        $steps = array('basicInfo', 'familyInfo', 'educationInfo', 'careerInfo', 'physicalAttributeInfo', 'partnerExpectation');

        if (!in_array($step, $steps)) {
            abort('404');
        }

        if ($request->has('back_to') && !in_array($request->back_to, $steps)) {
            $notify[] = ['error', 'The back to field isn\'t correct'];
            return back()->withNotify($notify);
        }

        $user = auth()->user();
        if ($user->profile_complete == Status::YES) {
            return to_route('user.home');
        }

        if ($request->has('back_to')) {
            $removedIndex = array_search($request->back_to, $steps) + 1;
            if (in_array($removedIndex, $user->skipped_step)) {
                $arrayValue = array_flip($user->skipped_step);
                unset($arrayValue[$removedIndex]);
                $arrayValue         = array_flip($arrayValue);
                $user->skipped_step = $arrayValue;
                $user->save();
            }

            if (in_array($removedIndex, $user->completed_step)) {
                $arrayValue = array_flip($user->completed_step);
                unset($arrayValue[$removedIndex]);
                $arrayValue           = array_flip($arrayValue);
                $user->completed_step = $arrayValue;
                $user->save();
            }

            return to_route('user.home');
        }

        $response = $this->$step($request, $user);

        if ($response instanceof RedirectResponse) {
            return true;
        }

        if ($response && isset($response['success']) && !$response['success']) {
            $notify[] = ['error', $response['message']];
            return back()->withNotify($notify);
        }

        return to_route('user.home');
    }

    public function addDeviceToken(Request $request) {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->all()];
        }

        $deviceToken = DeviceToken::where('token', $request->token)->first();

        if ($deviceToken) {
            return ['success' => true, 'message' => 'Already exists'];
        }

        $deviceToken          = new DeviceToken();
        $deviceToken->user_id = auth()->user()->id;
        $deviceToken->token   = $request->token;
        $deviceToken->is_app  = Status::NO;
        $deviceToken->save();

        return ['success' => true, 'message' => 'Token saved successfully'];
    }

    public function downloadAttachment($fileHash) {
        $filePath  = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $title     = slug(gs('site_name')) . '- attachments.' . $extension;
        try {
            $mimetype = mime_content_type($filePath);
        } catch (\Exception $e) {
            $notify[] = ['error', 'File does not exists'];
            return back()->withNotify($notify);
        }
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function information() {
        $user      = auth()->user();
        $pageTitle = 'Provide Your Information';
        return view('Template::user.information', compact('pageTitle', 'user'));
    }

    public function storeInformation(Request $request) {
        $countryData  = (array) json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));

        $user = auth()->user();

        $emailValidation       = 'nullable';
        $mobileValidation      = 'nullable';
        $mobileCodeValidation  = 'nullable';
        $countryCodeValidation = 'nullable';

        if (!$user->mobile) {
            $mobileValidation      = 'required|regex:/^([0-9]*)$/';
            $mobileCodeValidation  = 'required|in:' . $mobileCodes;
            $countryCodeValidation = 'required|in:' . $countryCodes;
        }

        if (!$user->email) {
            $emailValidation = 'required|string|email|unique:users';
        }

        $request->validate([
            'email'        => $emailValidation,
            'mobile'       => $mobileValidation,
            'mobile_code'  => $mobileCodeValidation,
            'country_code' => $countryCodeValidation,
        ]);

        if (!$user->mobile) {
            $exist = User::where('mobile', $request->mobile_code . $request->mobile)->first();
            if ($exist) {
                $notify[] = ['error', 'The mobile number already exists'];
                return back()->withNotify($notify)->withInput();
            }

            $user->country_code = $request->country_code;
            $user->mobile       = $request->mobile_code . $request->mobile;
        }

        if (!$user->email) {
            $user->email = $request->email;
        }

        $user->save();

        $notify[] = ['success', 'Information save successfully'];
        return to_route('user.data')->withNotify($notify);
    }

    protected function basicInfo($request, $user) {

        $countryData  = (array) json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));
        $countries    = implode(',', array_column($countryData, 'country'));

        $rules = [
            'birth_date'          => 'required|date_format:Y-m-d|before:today',
            'religion'            => 'required|exists:religion_infos,name',
            'gender'              => 'required|in:m,f',
            'profession'          => 'required|string',
            'financial_condition' => 'required|string',
            'smoking_status'      => 'required|in:0,1',
            'looking_for'         => 'required|in:1,2',
            'drinking_status'     => 'required|in:0,1',
            'marital_status'      => 'required|exists:marital_statuses,title',
            'languages'           => 'required|array',
            'languages.*'         => 'string',
            'country_code'        => 'required|in:' . $countryCodes,
            'country'             => 'required|in:' . $countries,
            'mobile_code'         => 'required|in:' . $mobileCodes,
            'username'            => 'required|unique:users|min:6',
            'mobile'              => ['required', 'regex:/^([0-9]*)$/', Rule::unique('users')->where('dial_code', $request->mobile_code)],
            'pre_state'           => 'nullable',
            'pre_zip'             => 'nullable',
            'pre_city'            => 'required',
            'per_state'           => 'nullable',
            'per_zip'             => 'nullable',
            'per_city'            => 'required',
        ];
        $messages = [
            'birth_date.required'          => 'Birth date is required',
            'birth_date.before'            => 'Birth date can\'t be greater than today',
            'religion.required'            => 'Religion is required',
            'gender.required'              => 'Gender field is required',
            'gender.in:m,f'                => 'Gender should be male or female only',
            'profession.required'          => 'Profession field is required',
            'profession.string'            => 'Profession should be string',
            'financial_condition.required' => 'Financial condition field is required',
            'financial_condition.string'   => 'Financial condition should be string',
            'smoking_status.required'      => 'Smoking Habits field is required',
            'smoking_status.in'            => 'Select a valid smoking habits',
            'looking_for.required'         => 'Looking for field is required',
            'looking_for.in'               => 'Select a valid looking for',
            'drinking_status.required'     => 'Drinking status field is required',
            'drinking_status.in'           => 'Drinking status should be in 0 or 1',
            'profession.required'          => 'Profession field is required',
            'profession.*.string'          => 'Profession should be string',
            'languages.required'           => 'Language field is required',
            'languages.*.string'           => 'Language should be string',
            'pre_city.required'            => 'Present city field is required',
            'per_country.required'         => 'Permanent country field is required',
            'per_city.required'            => 'Permanent city field is required',
        ];

        $request->validate($rules, $messages);

        if (preg_match("/[^a-z0-9_]/", trim($request->username))) {
            $notify[] = ['info', 'Username can contain only small letters, numbers and underscore.'];
            $notify[] = ['error', 'No special character, space or capital letters in username.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        $user->country_code = $request->country_code;
        $user->mobile       = $request->mobile;
        $user->username     = $request->username;

        $user->address      = $request->address;
        $user->city         = $request->city;
        $user->state        = $request->state;
        $user->zip          = $request->zip;
        $user->country_name = @$request->country;
        $user->dial_code    = $request->mobile_code;
        $user->looking_for  = $request->looking_for;

        $user->save();

        $basicInfo                      = new BasicInfo();
        $basicInfo->user_id             = $user->id;
        $basicInfo->gender              = $request->gender;
        $basicInfo->profession          = $request->profession;
        $basicInfo->financial_condition = $request->financial_condition;
        $basicInfo->religion            = $request->religion;
        $basicInfo->smoking_status      = $request->smoking_status;
        $basicInfo->drinking_status     = $request->drinking_status;
        $basicInfo->birth_date          = $request->birth_date;
        $basicInfo->language            = $request->languages;
        $basicInfo->marital_status      = $request->marital_status;
        $basicInfo->present_address     = [
            'country' => $user->country_name,
            'state'   => $request->pre_state,
            'zip'     => $request->pre_zip,
            'city'    => $request->pre_city,
        ];
        $basicInfo->permanent_address = [
            'country' => $request->per_country,
            'state'   => $request->per_state,
            'zip'     => $request->per_zip,
            'city'    => $request->per_city,
        ];
        $basicInfo->save();

        $this->updateRegistrationStep($user, 1, 'completed_step');
    }

    protected function familyInfo($request, $user) {
        if (!$request->has('button_value')) {
            $this->updateRegistrationStep($user, 2, 'skipped_step');
        } else {
            $rules = [
                'father_name'    => 'required',
                'father_contact' => 'required|numeric|gt:0',
                'mother_name'    => 'required',
                'mother_contact' => 'required|numeric|gt:0',
                'total_brother'  => 'nullable|min:0',
                'total_sister'   => 'nullable|min:0',
            ];
            $messages = [
                'father_name.required'    => 'Father\'s name is required',
                'father_contact.required' => 'Father\'s contact number is required',
                'father_contact.numeric'  => 'Father\'s contact number should be a number',
                'father_contact.gt'       => 'Father\'s contact number should be a positive number',
                'mother_name.required'    => 'Mother\'s name is required',
                'mother_contact.required' => 'Mother\'s contact is required',
                'mother_contact.numeric'  => 'Mothers\'s contact number should be a number',
                'mother_contact.gt'       => 'Mothers\'s contact number should be a positive number',
                'total_brother.min'       => 'Total brother can\'t be a negative number',
                'total_sister.min'        => 'Total sister can\'t be a negative number',
            ];

            $request->validate($rules, $messages);

            $familyInfo                    = new FamilyInfo();
            $familyInfo->user_id           = $user->id;
            $familyInfo->father_name       = $request->father_name;
            $familyInfo->father_profession = $request->father_profession;
            $familyInfo->father_contact    = $request->father_contact;
            $familyInfo->mother_name       = $request->mother_name;
            $familyInfo->mother_profession = $request->mother_profession;
            $familyInfo->mother_contact    = $request->mother_contact;
            $familyInfo->total_brother     = $request->total_brother ?? 0;
            $familyInfo->total_sister      = $request->total_sister ?? 0;
            $familyInfo->save();

            $this->updateRegistrationStep($user, 2, 'completed_step');
        }
    }

    protected function educationInfo($request, $user) {
        if (!$request->has('button_value')) {
            $this->updateRegistrationStep($user, 3, 'skipped_step');
        } else {
            $rules = [
                'institute'        => 'required|array',
                'institute.*'      => 'required|string',
                'degree'           => 'required|array',
                'degree.*'         => 'required|string',
                'field_of_study'   => 'required|array',
                'field_of_study.*' => 'required|string|max:255',
                'reg_no'           => 'nullable|array',
                'reg_no.*'         => 'nullable|integer|gt:0',
                'roll_no'          => 'nullable|array',
                'roll_no.*'        => 'nullable|integer|gt:0',
                'start'            => 'required|array',
                'start.*'          => 'required|integer|gt:0|digits:4|max:' . date('Y'),
                'end'              => 'nullable|array',
                'end.*'            => 'nullable|integer|gt:0|digits:4|max:' . date('Y'),
                'result'           => 'nullable|array',
                'result.*'         => 'nullable|numeric|gte:0',
                'out_of'           => 'nullable|array',
                'out_of.*'         => 'nullable|numeric|gte:0',
            ];

            $messages = [
                'institute.required'        => 'Institute field is required',
                'institute.*.required'      => 'Institute field is required',
                'degree.required'           => 'Degree field is required',
                'degree.*.required'         => 'Degree field is required',
                'field_of_study.*.required' => 'Field of study is required',
                'field_of_study.*.string'   => 'Field of study must be a string',
                'field_of_study.*.max'      => 'Field of study must not be greater than 255 characters',
                'reg_no.*.integer'          => 'Registration number should be a number',
                'reg_no.*.gt'               => 'Registration number should be a positive number',
                'roll_no.*.integer'         => 'Roll number should be a number',
                'roll_no.*.gt'              => 'Roll number should be a positive number',
                'start.required'            => 'Starting year field is required',
                'start.*.required'          => 'Starting year field is required',
                'start.*.integer'           => 'Starting year should be a year',
                'start.*.digits'            => 'Starting year should be a year',
                'start.*.gt'                => 'Starting year should be a year',
                'start.*.max'               => 'Starting year can\'t be greater than current year',
                'end.*.integer'             => 'Ending year should be a year',
                'end.*.digits'              => 'Ending year should be a year',
                'end.*.gt'                  => 'Ending year should be a year',
                'end.*.max'                 => 'Ending year can\'t be greater than current year',
                'result.*.numeric'          => 'Result should be a number',
                'result.*.gte'              => 'Result can\'t be a negative number',
                'out_of.*.numeric'          => 'Out of should be a number',
                'out_of.*.gte'              => 'Out of can\'t be a negative number',
            ];

            $request->validate($rules, $messages);
            if ($request->end) {
                foreach ($request->end as $key => $end) {
                    if ($end && $request->start[$key] > $end) {
                        return ['success' => false, 'message' => 'Ending year can\'t be less than starting year'];
                    }
                }
            }

            foreach ($request->degree as $key => $degree) {
                $educationInfo                 = new EducationInfo();
                $educationInfo->user_id        = $user->id;
                $educationInfo->degree         = $degree;
                $educationInfo->field_of_study = $request->field_of_study[$key];
                $educationInfo->institute      = $request->institute[$key];
                $educationInfo->reg_no         = $request->reg_no[$key] ?? 0;
                $educationInfo->roll_no        = $request->roll_no[$key] ?? 0;
                $educationInfo->start          = $request->start[$key];
                $educationInfo->end            = $request->end[$key];
                $educationInfo->result         = $request->result[$key];
                $educationInfo->out_of         = $request->out_of[$key];
                $educationInfo->save();
            }
            $this->updateRegistrationStep($user, 3, 'completed_step');
        }
    }

    protected function careerInfo($request, $user) {
        if (!$request->has('button_value')) {
            $this->updateRegistrationStep($user, 4, 'skipped_step');
        } else {
            $rules = [
                'company'       => 'required|array',
                'company.*'     => 'required|string|max:255',
                'designation'   => 'required|array',
                'designation.*' => 'required|string|max:40',
                'start'         => 'required|array',
                'start.*'       => 'required|integer|digits:4|gt:0|lte:' . date('Y'),
                'end'           => 'nullable|array',
                'end.*'         => 'nullable|integer|digits:4|lte:' . date('Y'),
            ];

            $messages = [
                'company.*.required'     => 'Company name is required',
                'company.*.max'          => 'Company name must not be greater than 255 characters',
                'designation.*.required' => 'The designation field is required',
                'designation.*.max'      => 'Designation must not be greater than 40 characters',
                'start.*.required'       => 'Starting year field is required',
                'start.*.integer'        => 'Starting year should be a year',
                'start.*.gt'             => 'Starting year should be a year',
                'start.*.digits'         => 'Starting year should be a year',
                'start.*.lte'            => 'Starting year should be less than or equal to current year',
                'end.*.integer'          => 'Ending year should be a year',
                'end.*.gt'               => 'Ending year should be a year',
                'end.*.digits'           => 'Ending year should be a year',
                'end.*.lte'              => 'Ending year should be less than or equal to current year',
            ];

            $request->validate($rules, $messages);
            if ($request->end) {
                foreach ($request->end as $key => $end) {
                    if ($end && $request->start[$key] > $end) {
                        return ['success' => false, 'message' => 'Ending year can\'t be less than starting year'];
                    }
                }
            }
            foreach ($request->company as $key => $company) {
                $careerInfo              = new CareerInfo();
                $careerInfo->user_id     = $user->id;
                $careerInfo->company     = $company;
                $careerInfo->designation = $request->designation[$key];
                $careerInfo->start       = $request->start[$key];
                $careerInfo->end         = $request->end[$key];
                $careerInfo->save();
            }
            $this->updateRegistrationStep($user, 4, 'completed_step');
        }
    }

    protected function physicalAttributeInfo($request, $user) {
        if (!$request->has('button_value')) {
            $this->updateRegistrationStep($user, 5, 'skipped_step');
        } else {
            $rules = [
                'height'      => 'required|numeric|gt:0',
                'weight'      => 'required|numeric|gt:0',
                'blood_group' => 'required|exists:blood_groups,name',
                'eye_color'   => 'required|string|max:40',
                'hair_color'  => 'required|string|max:40',
                'complexion'  => 'required|string|max:255',
                'disability'  => 'nullable|string|max:40',
            ];

            $messages = [
                'height.required'      => 'Height field is required',
                'height.numeric'       => 'Height should be a number',
                'height.gt'            => 'Height can\'t be a negative number',
                'weight.required'      => 'Weight field is required',
                'weight.numeric'       => 'Weight should be a number',
                'weight.gt'            => 'Weight can\'t be a negative number',
                'blood_group.required' => 'Blood group field is required',
                'eye_color.required'   => 'Eye color field is required',
                'eye_color.string'     => 'Eye color field should be string',
                'eye_color.max'        => 'Eye color must not be greater than 40 characters',
                'hair_color.required'  => 'Hair color field is required',
                'hair_color.string'    => 'Hair color field should be string',
                'hair_color.max'       => 'Hair color must not be greater than 40 characters',
                'complexion.required'  => 'Complexion field is required',
                'complexion.string'    => 'Complexion field should be string',
                'complexion.max'       => 'Complexion must not be greater than 255 characters',
                'disability.string'    => 'Disability field should be string',
                'disability.max'       => 'disability must not be greater than 40 characters',
            ];

            $request->validate($rules, $messages);

            $physicalAttribute              = new PhysicalAttribute();
            $physicalAttribute->user_id     = $user->id;
            $physicalAttribute->height      = $request->height;
            $physicalAttribute->weight      = $request->weight;
            $physicalAttribute->blood_group = $request->blood_group;
            $physicalAttribute->eye_color   = $request->eye_color;
            $physicalAttribute->hair_color  = $request->hair_color;
            $physicalAttribute->complexion  = $request->complexion;
            $physicalAttribute->disability  = $request->disability;
            $physicalAttribute->save();

            $this->updateRegistrationStep($user, 5, 'completed_step');
        }
    }

    protected function partnerExpectation($request, $user) {
        if (!$request->has('button_value')) {
            $this->updateRegistrationStep($user, 6, 'skipped_step');
        } else {
            $rules = [
                'general_requirement' => 'nullable|string|max:255',
                'country'             => 'nullable',
                'min_age'             => 'nullable|integer|gt:0',
                'max_age'             => 'nullable|integer|gt:0',
                'min_height'          => 'nullable|numeric|gt:0',
                'max_height'          => 'nullable|numeric|gt:0',
                'max_weight'          => 'nullable|numeric|gt:0',
                'marital_status'      => 'nullable',
                'religion'            => 'nullable|exists:religion_infos,name',
                'complexion'          => 'nullable|string|max:255',
                'smoking_status'      => 'nullable|in:1,2',
                'drinking_status'     => 'nullable|in:1,2',
                'language'            => 'nullable|array',
                'language.*'          => 'string',
                'min_degree'          => 'nullable|string|max:40',
                'personality'         => 'nullable|string|max:40',
                'profession'          => 'nullable|string|max:40',
                'financial_condition' => 'nullable|string|max:40',
                'family_position'     => 'nullable|string|max:40',
            ];

            $messages = [
                'general_requirement.string' => 'General requirement should be string',
                'general_requirement.max'    => 'General requirement must not be greater than 255 words',
                'min_age.integer'            => 'Minimum age should be integer',
                'min_age.gt'                 => 'Minimum age can\'t be a negative number',
                'max_age.integer'            => 'Maximum age should be integer',
                'max_age.gt'                 => 'Maximum age can\'t be a negative number',
                'min_height.numeric'         => 'Minimum height should be a number',
                'min_height.gt'              => 'Minimum height can\'t be a negative number',
                'max_height.numeric'          => 'Maximum height should be a number',
                'max_height.gt'               => 'Maximum height can\'t be a negative number',
                'max_weight.numeric'         => 'Minimum height should be a number',
                'max_weight.gt'              => 'Minimum height can\'t be a negative number',
                'complexion.string'          => 'Complexion should be string',
                'complexion.max'             => 'Complexion must not be greater than 255 words',
                'min_degree.string'          => 'Minimum degree should be string',
                'min_degree.max'             => 'Minimum degree must not be greater than 40 words',
                'personality.string'         => 'Personality should be string',
                'personality.max'            => 'Personality must not be greater than 40 words',
                'profession.string'          => 'Profession should be string',
                'profession.max'             => 'Profession must not be greater than 40 words',
                'financial_condition.string' => 'Financial condition should be string',
                'financial_condition.max'    => 'Financial condition must not be greater than 40 words',
                'family_position.string'     => 'Family position should be string',
                'family_position.max'        => 'Family position must not be greater than 40 words',
            ];

            $request->validate($rules, $messages);

            $partnerExpectation                      = new PartnerExpectation();
            $partnerExpectation->user_id             = $user->id;
            $partnerExpectation->general_requirement = $request->general_requirement;
            $partnerExpectation->country             = $request->country;
            $partnerExpectation->min_age             = $request->min_age;
            $partnerExpectation->max_age             = $request->max_age;
            $partnerExpectation->min_height          = $request->min_height;
            $partnerExpectation->max_height          = $request->max_height;
            $partnerExpectation->max_weight          = $request->max_weight;
            $partnerExpectation->marital_status      = $request->marital_status;
            $partnerExpectation->religion            = $request->religion;
            $partnerExpectation->complexion          = $request->complexion;
            $partnerExpectation->smoking_status      = $request->smoking_status ?? 0;
            $partnerExpectation->drinking_status     = $request->drinking_status ?? 0;
            $partnerExpectation->language            = $request->language ?? [];
            $partnerExpectation->min_degree          = $request->min_degree;
            $partnerExpectation->profession          = $request->profession;
            $partnerExpectation->personality         = $request->personality;
            $partnerExpectation->financial_condition = $request->financial_condition;
            $partnerExpectation->family_position     = $request->family_position;
            $partnerExpectation->save();

            $this->updateRegistrationStep($user, 6, 'completed_step');
        }
    }

    protected function updateRegistrationStep($user, $index, $column) {
        $array = $user->$column;

        if (!in_array($index, $array)) {
            array_push($array, $index);
        }

        $user->$column = $array;
        if ($index == 6) {
            $user->profile_complete = 1;
        }
        $user->save();
    }
}
