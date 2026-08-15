<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\BloodGroup;
use App\Models\CareerInfo;
use App\Models\MaritalStatus;
use App\Models\ReligionInfo;
use App\Models\CasteInfo;
use App\Models\PartnerExpectation;
use App\Models\PhysicalAttribute;
use App\Models\FamilyInfo;
use App\Models\EducationInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Rules\FileTypeValidate;

class ProfileController extends Controller
{
    public function profile()
    {
        $pageTitle = "Profile Setting";
        $userId = auth()->id();
        $user = User::with('basicInfo', 'partnerExpectation', 'physicalAttributes', 'family', 'careerInfo', 'educationInfo')->findOrFail($userId);
        $religions = ReligionInfo::get();
        $castes = CasteInfo::get();
        $maritalStatuses = MaritalStatus::get();
        $bloodGroups = BloodGroup::get();
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));

        return view('Template::user.profile_setting.index', compact('pageTitle', 'user', 'religions', 'castes', 'maritalStatuses', 'countries', 'bloodGroups'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'method' => 'required'
        ]);
        $user = auth()->user();
        $method = $request->method;

        try {
            $notify = $this->$method($request, $user);
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify)->withInput($request->all());
        }

        return back()->withNotify($notify);
    }

    private function basicInfo($request, $user)
    {
        $rules = [
            'firstname'           => 'required',
            'lastname'            => 'required',
            'birth_date'          => 'required|date_format:Y-m-d|before:today',
            'religion'            => 'required|exists:religion_infos,name',
            'caste'               => 'nullable|exists:caste_infos,name',
            'gender'              => 'required|in:m,f',
            'financial_condition' => 'required|string',
            'smoking_status'      => 'required|in:0,1',
            'drinking_status'     => 'required|in:0,1',
            'marital_status'      => 'required|exists:marital_statuses,title',
            'profession'          => 'required|string',
            'language'            => 'required|array',
            'language.*'          => 'string',
            'pre_state'           => 'nullable',
            'pre_zip'             => 'nullable',
            'pre_city'            => 'required',
            'per_country'         => 'required',
            'per_state'           => 'nullable',
            'per_zip'             => 'nullable',
            'per_city'            => 'required'
        ];
        $messages = [
            'firstname.required'           => 'First name is required',
            'lastname.required'            => 'Last name is required',
            'birth_date.required'          => 'Birth date is required',
            'birth_date.before'            => 'Birth date can\'t be greater than today',
            'religion.required'            => 'Religion is required',
            'caste.exists'                  => 'Select a valid caste',
            'gender.required'              => 'Gender field is required',
            'gender.in:m,f'                => 'Gender should be male or female only',
            'profession.required'          => 'Profession field is required',
            'profession.string'            => 'Profession should be string',
            'financial_condition.required' => 'Financial condition field is required',
            'financial_condition.string'   => 'Financial condition should be string',
            'smoking_status.required'      => 'Smoking Habits field is required',
            'smoking_status.in'            => 'Smoking Habits should be in 0 or 1',
            'drinking_status.required'     => 'Drinking status field is required',
            'drinking_status.in'           => 'Drinking status should be in 0 or 1',
            'profession.*.string'          => 'Profession should be string',
            'language.required'            => 'Language field is required',
            'language.*.string'            => 'Language should be string',
            'pre_city.required'            => 'Present city field is required',
            'per_country.required'         => 'Permanent country field is required',
            'per_city.required'            => 'Permanent city field is required'
        ];

        $request->validate($rules, $messages);



        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->save();

        $basicInfo = BasicInfo::where('user_id', $user->id)->first();

        $notification = 'Basic Information updated successfully';
        if (!$basicInfo) {
            $basicInfo = new BasicInfo();
            $basicInfo->user_id  = $user->id;
            $notification = 'Basic Information added successfully';
        }
        $basicInfo->gender              = $request->gender;
        $basicInfo->profession          = $request->profession;
        $basicInfo->financial_condition = $request->financial_condition;
        $basicInfo->religion            = $request->religion;
        $basicInfo->caste               = $request->caste;
        $basicInfo->smoking_status      = $request->smoking_status;
        $basicInfo->drinking_status     = $request->drinking_status;
        $basicInfo->birth_date          = $request->birth_date;
        $basicInfo->language            = $request->language;
        $basicInfo->marital_status      = $request->marital_status;
        $basicInfo->present_address = [
            'country'  => @$user->address->country ?? $request->per_country,
            'state'    => $request->pre_state,
            'zip'      => $request->pre_zip,
            'city'     => $request->pre_city,
        ];
        $basicInfo->permanent_address = [
            'country'  => $request->per_country,
            'state'    => $request->per_state,
            'zip'      => $request->per_zip,
            'city'     => $request->per_city,
        ];
        $basicInfo->save();
        $notify[] = ['success', $notification];
        return $notify;
    }

    private function partnerExpectation($request, $user)
    {
        $rules                    = [
            'general_requirement' => 'nullable|string|max:255',
            'country'             => 'nullable',
            'min_age'             => 'nullable|integer|gt:0',
            'max_age'             => 'nullable|integer|gt:0',
            'min_height'          => 'nullable|numeric|gt:0',
            'max_height'          => 'nullable|numeric|gt:0',
            'max_weight'          => 'nullable|numeric|gt:0',
            'marital_status'      => 'nullable',
            'religion'            => 'nullable|exists:religion_infos,name',
            'caste'               => 'nullable|exists:caste_infos,name',
            'complexion'          => 'nullable|string|max:255',
            'smoking_status'      => 'nullable|in:0,1,2',
            'drinking_status'     => 'nullable|in:0,1,2',
            'language'            => 'nullable|array',
            'language.*'          => 'string',
            'min_degree'          => 'nullable|string|max:40',
            'personality'         => 'nullable|string|max:40',
            'profession'          => 'nullable|string|max:40',
            'financial_condition' => 'nullable|string|max:40',
            'family_position'     => 'nullable|string|max:40'
        ];

        $messages = [
            'general_requirement.string'  => 'General requirement should be string',
            'general_requirement.max'     => 'General requirement must not be greater than 255 words',
            'min_age.integer'             => 'Minimum age should be integer',
            'min_age.gt'                  => 'Minimum age can\'t be a negative number',
            'max_age.integer'             => 'Maximum age should be integer',
            'max_age.gt'                  => 'Maximum age can\'t be a negative number',
            'min_height.numeric'          => 'Minimum height should be a number',
            'min_height.gt'               => 'Minimum height can\'t be a negative number',
            'max_height.numeric'          => 'Maximum height should be a number',
            'max_height.gt'               => 'Maximum height can\'t be a negative number',
            'max_weight.numeric'          => 'Minimum height should be a number',
            'max_weight.gt'               => 'Minimum height can\'t be a negative number',
            'complexion.string'           => 'Complexion should be string',
            'complexion.max'              => 'Complexion must not be greater than 255 words',
            'min_degree.string'           => 'Minimum degree should be string',
            'min_degree.max'              => 'Minimum degree must not be greater than 40 words',
            'personality.string'          => 'Personality should be string',
            'personality.max'             => 'Personality must not be greater than 40 words',
            'profession.string'           => 'Profession should be string',
            'profession.max'              => 'Profession must not be greater than 40 words',
            'financial_condition.string'  => 'Financial condition should be string',
            'financial_condition.max'     => 'Financial condition must not be greater than 40 words',
            'family_position.string'      => 'Family position should be string',
            'family_position.max'         => 'Family position must not be greater than 40 words',
        ];

        $request->validate($rules, $messages);

        $partnerExpectation  = PartnerExpectation::where('user_id', $user->id)->first();
        $notification = 'Partner expectation updated successfully';
        if (!$partnerExpectation) {
            $partnerExpectation = new PartnerExpectation();
            $partnerExpectation->user_id = $user->id;
            $notification = 'Partner expectation added successfully';
        }
        $partnerExpectation->general_requirement = $request->general_requirement;
        $partnerExpectation->country = $request->country;
        $partnerExpectation->min_age = $request->min_age;
        $partnerExpectation->max_age = $request->max_age;
        $partnerExpectation->min_height = $request->min_height;
        $partnerExpectation->max_height = $request->max_height;
        $partnerExpectation->max_weight = $request->max_weight;
        $partnerExpectation->marital_status = $request->marital_status;
        $partnerExpectation->religion = $request->religion;
        $partnerExpectation->caste = $request->caste;
        $partnerExpectation->complexion = $request->complexion;
        $partnerExpectation->smoking_status = $request->smoking_status ?? 0;
        $partnerExpectation->drinking_status = $request->drinking_status ?? 0;
        $partnerExpectation->language = $request->language ?? [];
        $partnerExpectation->min_degree = $request->min_degree;
        $partnerExpectation->profession = $request->profession;
        $partnerExpectation->personality = $request->personality;
        $partnerExpectation->financial_condition = $request->financial_condition;
        $partnerExpectation->family_position = $request->family_position;
        $partnerExpectation->save();

        $notify[] = ['success', $notification];
        return $notify;
    }

    private function physicalAttributes($request, $user)
    {
        $rules = [
            'height'      => 'required|numeric|gt:0',
            'weight'      => 'required|numeric|gt:0',
            'blood_group' => 'required|exists:blood_groups,name',
            'eye_color'   => 'required|string|max:40',
            'hair_color'  => 'required|string|max:40',
            'complexion'  => 'required|string|max:255',
            'disability'  => 'nullable|string|max:40'
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
        $physicalAttribute = PhysicalAttribute::where('user_id', $user->id)->first();
        $notification = 'Physical attributes updated successfully';
        if (!$physicalAttribute) {
            $physicalAttribute              = new PhysicalAttribute();
            $physicalAttribute->user_id     = $user->id;
            $notification = 'Physical attributes added successfully';
        }
        $physicalAttribute->height      = $request->height;
        $physicalAttribute->weight      = $request->weight;
        $physicalAttribute->blood_group = $request->blood_group;
        $physicalAttribute->eye_color   = $request->eye_color;
        $physicalAttribute->hair_color  = $request->hair_color;
        $physicalAttribute->complexion  = $request->complexion;
        $physicalAttribute->disability  = $request->disability;
        $physicalAttribute->save();

        $notify[] = ['success', $notification];
        return $notify;
    }

    private function familyInfo($request, $user)
    {
        $rules = [
            'father_name'    => 'required',
            'father_contact' => 'numeric|gt:0',
            'mother_name'    => 'required',
            'mother_contact' => 'numeric|gt:0',
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
            'total_sister.min'        => 'Total sister can\'t be a negative number'
        ];

        $request->validate($rules, $messages);
        $familyInfo = FamilyInfo::where('user_id', $user->id)->first();
        $notification = 'Family information updated successfully';

        if (!$familyInfo) {
            $familyInfo = new FamilyInfo();
            $familyInfo->user_id = $user->id;
            $notification = 'Family information added successfully';
        }

        $familyInfo->father_name = $request->father_name;
        $familyInfo->father_profession = $request->father_profession;
        $familyInfo->father_contact = $request->father_contact;
        $familyInfo->mother_name = $request->mother_name;
        $familyInfo->mother_profession = $request->mother_profession;
        $familyInfo->mother_contact = $request->mother_contact;
        $familyInfo->total_brother = $request->total_brother ?? 0;
        $familyInfo->total_sister = $request->total_sister ?? 0;
        $familyInfo->save();

        $notify[] = ['success', $notification];
        return $notify;
    }

    public function updateCareerInfo(Request $request, $id = 0)
    {
        $rules = [
            'company'       => 'required|string|max:255',
            'designation'   => 'required|string|max:40',
            'start'       => 'required|integer|digits:4|gt:0|lte:' . date('Y'),
            'end'         => 'nullable|integer|digits:4|after:start|lte:' . date('Y')
        ];

        $messages = [
            'company.required'     => 'Company name is required',
            'company.max'          => 'Company name must not be greater than 255 characters',
            'designation.required' => 'The designation field is required',
            'designation.max'      => 'Designation must not be greater than 40 characters',
            'start.required'       => 'Starting year field is required',
            'start.integer'        => 'Starting year should be a year',
            'start.gt'             => 'Starting year should be a year',
            'start.digits'         => 'Starting year should be a year',
            'start.lte'            => 'Starting year should be less than or equal to current year',
            'end.integer'          => 'Ending year should be a year',
            'end.gt'               => 'Ending year should be a year',
            'end.digits'           => 'Ending year should be a year',
            'end.lte'              => 'Ending year should be less than or equal to current year',
            'end.after'            => 'Ending year should be greater than starting year'
        ];

        $request->validate($rules, $messages);


        if (!$id) {
            $careerInfo = new CareerInfo();
            $careerInfo->user_id = auth()->id();
            $notification = 'Career information added successfully';
        } else {
            $careerInfo  = CareerInfo::findOrFail($id);
            $notification = 'Career information updated successfully';
        }

        $careerInfo->company     = $request->company;
        $careerInfo->designation = $request->designation;
        $careerInfo->start       = $request->start;
        $careerInfo->end         = $request->end;
        $careerInfo->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function deleteCareerInfo($id)
    {
        $career = CareerInfo::findOrFail($id);
        $career->delete();
        $notify[] = ['success', 'Career information deleted successfully'];
        return back()->withNotify($notify);
    }

    public function updateEducationInfo(Request $request, $id = 0)
    {
        $rules = [
            'institute'      => 'required|string',
            'degree'         => 'required|string',
            'field_of_study' => 'required|string|max:255',
            'reg_no'         => 'nullable|integer|gt:0',
            'roll_no'        => 'nullable|integer|gt:0',
            'start'          => 'required|integer|gt:0|digits:4|max:' . date('Y'),
            'end'            => 'nullable|integer|gt:0|digits:4|after:start|max:' . date('Y'),
            'result'         => 'nullable|numeric|gte:0',
            'out_of'         => 'nullable|numeric|gte:0'
        ];

        $messages = [
            'institute.required'      => 'Institute field is required',
            'degree.required'         => 'Degree field is required',
            'field_of_study.required' => 'Field of study is required',
            'field_of_study.string'   => 'Field of study must be a string',
            'field_of_study.max'      => 'Field of study must not be greater than 255 characters',
            'reg_no.integer'          => 'Registration number should be a number',
            'reg_no.gt'               => 'Registration number should be a positive number',
            'roll_no.integer'         => 'Roll number should be a number',
            'roll_no.gt'              => 'Roll number should be a positive number',
            'start.required'          => 'Starting year field is required',
            'start.integer'           => 'Starting year should be a year',
            'start.digits'            => 'Starting year should be a year',
            'start.gt'                => 'Starting year should be a year',
            'start.max'               => 'Starting year can\'t be greater than current year',
            'end.integer'             => 'Ending year should be a year',
            'end.digits'              => 'Ending year should be a year',
            'end.after'               => 'Ending year should be greater than starting year',
            'end.gt'                  => 'Ending year should be a year',
            'end.max'                 => 'Ending year can\'t be greater than current year',
            'result.numeric'          => 'Result should be a number',
            'result.gte'              => 'Result can\'t be a negative number',
            'out_of.numeric'          => 'Out of should be a number',
            'out_of.gte'              => 'Out of can\'t be a negative number'
        ];

        $request->validate($rules, $messages);
        if (!$id) {
            $educationInfo = new EducationInfo();
            $educationInfo->user_id = auth()->id();
            $notification = 'Education information added successfully';
        } else {
            $educationInfo = EducationInfo::findOrFail($id);
            $notification = 'Education information updated successfully';
        }


        $educationInfo->degree = $request->degree;
        $educationInfo->field_of_study = $request->field_of_study;
        $educationInfo->institute = $request->institute;
        $educationInfo->reg_no = $request->reg_no;
        $educationInfo->roll_no = $request->roll_no;
        $educationInfo->start = $request->start;
        $educationInfo->end = $request->end;
        $educationInfo->result = $request->result;
        $educationInfo->out_of = $request->out_of;
        $educationInfo->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function deleteEducationInfo($id)
    {
        $education = EducationInfo::findOrFail($id);
        $education->delete();

        $notify[] = ['success', 'Education information deleted successfully'];
        return back()->withNotify($notify);
    }
    public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view('Template::user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {

        $passwordValidation = Password::min(6);
        $general = gs();
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', $passwordValidation]
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'image' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($request->hasFile('image')) {
            try {
                $fileName = fileUploader($request->image, getFilePath('userProfile'), getFileSize('userProfile'), $user->image);
                $user->image = $fileName;
                $user->save();
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload the image'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Profile picture updated successfully'];
        return back()->withNotify($notify);
    }
}
