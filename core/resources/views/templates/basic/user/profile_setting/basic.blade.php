 <!-- Basic information -->
 <div class="public-profile__accordion accordion custom--accordion" id="accordionPanelsStayOpenExample">
     <div class="accordion-item basic-information" id="basicInformation">
         <h2 class="accordion-header" id="panelsStayOpen-basicInfo">
             <button class="accordion-button" data-bs-target="#panelsStayOpen-collapseBasicInfo" data-bs-toggle="collapse" type="button" aria-controls="panelsStayOpen-collapseBasicInfo" aria-expanded="true">
                 @lang('Basic Information')
             </button>
         </h2>
         <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseBasicInfo" aria-labelledby="panelsStayOpen-basicInfo">
             <div class="accordion-body">
                 <form class="basic-info" action="" autocomplete="off" method="POST">
                     @csrf
                     <input name="method" type="hidden" value="basicInfo">
                     <div class="row gy-4">
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="firstname" type="text" value="{{ old('firstname', @$user->firstname) }}" required>
                                 <label class="form--label">@lang('First Name')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="lastname" type="text" value="{{ old('lastname', @$user->lastname) }}" required>
                                 <label class="form--label">@lang('Last Name')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="birth-date form-control form--control" name="birth_date" data-date-format="yyyy-mm-dd" data-language="en" data-position='bottom right' data-range="false" type="text" value="{{ old('birth_date', @$user->basicInfo->birth_date) }}" autocomplete="off" required>
                                 <label class="form--label">@lang('Date Of Birth')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="religion" required>
                                     <option value="">@lang('Select One')</option>
                                     @foreach ($religions as $religion)
                                         <option value="{{ $religion->name }}" @selected(old('religion', @$user->basicInfo->religion) == $religion->name)>
                                             {{ __($religion->name) }}
                                         </option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Religion')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="gender">
                                     <option value="">@lang('Select')</option>
                                     <option value="m" @selected(old('gender', @$user->basicInfo->gender) == 'm')>@lang('Male')</option>
                                     <option value="f" @selected(old('gender', @$user->basicInfo->gender) == 'f')>@lang('Female')</option>
                                 </select>
                                 <label class="form--label">@lang('Gender')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="marital_status">
                                     <option value="">@lang('Select One')</option>
                                     @foreach ($maritalStatuses as $maritalStatus)
                                         <option value="{{ $maritalStatus->title }}" @selected(old('marital_status', @$user->basicInfo->marital_status) == $maritalStatus->title)>
                                             {{ __($maritalStatus->title) }}
                                         </option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Marital Status')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-control form--control select2-auto-tokenize" name="language[]" multiple="multiple" required placeholder="none">
                                     @if (@$user->basicInfo)
                                         @foreach (@$user->basicInfo->language as $language)
                                             <option value="{{ $language }}" selected>{{ $language }}</option>
                                         @endforeach
                                     @endif
                                 </select>
                                 <label class="form--label">@lang('Languages')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="profession" type="text" value="{{ old('profession', @$user->basicInfo->profession) }}" required>
                                 <label class="form--label">@lang('Profession')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="financial_condition" type="text" value="{{ old('financial_condition', @$user->basicInfo->financial_condition) }}" required>
                                 <label class="form--label">@lang('Financial Condition')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="smoking_status">
                                     <option value="">@lang('Select One')</option>
                                     <option value="0" @selected(old('smoking_status', @$user->basicInfo->smoking_status) == 0)>@lang('Non-smoker')</option>
                                     <option value="1" @selected(old('smoking_status', @$user->basicInfo->smoking_status) == 1)>@lang('Smoker')</option>
                                 </select>
                                 <label class="form--label">@lang('Smoking Habits')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="drinking_status">
                                     <option value="">@lang('Select One')</option>
                                     <option value="0" @selected(old('drinking_status', @$user->basicInfo->drinking_status) == 0)>@lang('Non-drunker')</option>
                                     <option value="1" @selected(old('drinking_status', @$user->basicInfo->drinking_status) == 1)>@lang('Drunker')</option>
                                 </select>
                                 <label class="form--label">@lang('Drinking Status')</label>
                             </div>
                         </div>

                         <small class="mt-3">@lang('Present Address')</small>

                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="pre_country" @disabled(@$user->basicInfo->present_address->country)>
                                     <option value="">@lang('Select One')</option>
                                     @foreach ($countries as $country)
                                         <option value="{{ $country->country }}" @selected(old('pre_country', @$user->basicInfo->present_address->country) == $country->country)>
                                             {{ __($country->country) }}
                                         </option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Present Country')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="pre_state" type="text" value="{{ old('pre_state', @$user->basicInfo->present_address->state) }}">
                                 <label class="form--label">@lang('State')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="pre_zip" type="text" value="{{ old('pre_zip', @$user->basicInfo->present_address->zip) }}">
                                 <label class="form--label">@lang('Zip Code')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="pre_city" type="text" value="{{ old('pre_city', @$user->basicInfo->present_address->city) }}" required>
                                 <label class="form--label">@lang('City')</label>
                             </div>
                         </div>

                         <small class="mt-3">
                             <div class="form--check">
                                 @lang('Permanent Address') :
                                 <input class="form-check-input" id="copyAddress" type="checkbox">
                                 <label class="form-check-label" for="copyAddress">
                                     @lang('Same as present address?')
                                 </label>
                             </div>
                         </small>

                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="select2 form-control form--control" name="per_country">
                                     <option value="">@lang('Select One')</option>
                                     @foreach ($countries as $country)
                                         <option value="{{ $country->country }}" @selected(old('per_country', @$user->basicInfo->permanent_address->country) == $country->country)>
                                             {{ __($country->country) }}
                                         </option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Permanent Country')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control permanent" name="per_state" type="text" value="{{ old('per_state', @$user->basicInfo->permanent_address->state) }}">
                                 <label class="form--label">@lang('State')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control permanent" name="per_zip" type="text" value="{{ old('per_zip', @$user->basicInfo->permanent_address->zip) }}">
                                 <label class="form--label">@lang('Zip Code')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control permanent" name="per_city" type="text" value="{{ old('per_city', @$user->basicInfo->permanent_address->city) }}" required>
                                 <label class="form--label">@lang('City')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- Basic information end-->

 @push('script-lib')
     <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
     <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
 @endpush

 @push('script')
     <script>
         (function($) {
             "use strict";

             $('.birth-date').datepicker({
                 autoClose: true
             });

             $('#copyAddress').on('change', function() {
                 if ($(this).is(':checked')) {
                     let country = $('[name=pre_country]').val();
                     let state = $('[name=pre_state]').val();
                     let zip = $('[name=pre_zip]').val();
                     let city = $('[name=pre_city]').val();

                     $('[name=per_country] [value="' + country + '"]').prop('selected', true);
                     $('[name=per_state]').val(state);
                     $('[name=per_zip]').val(zip);
                     $('[name=per_city]').val(city);
                 } else {
                     $('.permanent').val('');
                 }
             });

             let basicForm = $('.basic-info');
             let religion = "{{ @$user->basicInfo->religion }}";
             let gender = "{{ @$user->basicInfo->gender }}";
             let maritalStatus = "{{ @$user->basicInfo->marital_status }}";
             let smokingStatus = "{{ @$user->basicInfo->smoking_status }}";
             let drinkingStatus = "{{ @$user->basicInfo->drinking_status }}";
             let permanentCountry = "{{ @$user->basicInfo->permanent_address->country }}";

             basicForm.find('[name=religion]').val(religion);
             basicForm.find('[name=gender]').val(gender);
             basicForm.find('[name=marital_status]').val(maritalStatus);
             basicForm.find('[name=smoking_status]').val(smokingStatus);
             basicForm.find('[name=drinking_status]').val(drinkingStatus);
             basicForm.find('[name=per_country]').val(permanentCountry);
         })(jQuery)
     </script>
 @endpush
