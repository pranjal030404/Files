 <!-- Partner Expectation -->
 <div class="public-profile__accordion accordion custom--accordion" id="accordionPanelsStayOpenExample">
     <div class="accordion-item partner-expectation">
         <h2 class="accordion-header" id="panelsStayOpen-partnerExp">
             <button class="accordion-button collapsed" data-bs-target="#panelsStayOpen-collapsePartnerExp" data-bs-toggle="collapse" type="button" aria-expanded="false" aria-expanded="false" aria-controls="panelsStayOpen-collapsePartnerExp">
                 @lang('Partner Expectation')
             </button>
         </h2>
         <div class="accordion-collapse collapse" id="panelsStayOpen-collapsePartnerExp" aria-labelledby="panelsStayOpen-partnerExp">
             <div class="accordion-body">
                 <form class="partner-expectation-form" action="" autocomplete="off" method="POST">
                     @csrf
                     <input name="method" type="hidden" value="partnerExpectation">
                     <div class="row gy-4">
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <textarea class="form-control form--control" name="general_requirement">{{ @$user->partnerExpectation->general_requirement }}</textarea>
                                 <label class="form--label">@lang('General Requirement')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <select name="country"class="select2 form-control form--control">
                                     <option value="">@lang('Country')</option>
                                     @foreach ($countries as $country)
                                         <option value="{{ $country->country }}">{{ __($country->country) }}
                                         </option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Country')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="min_age" type="number" value="{{ @$user->partnerExpectation->min_age }}" min="0" step="any">
                                 <label class="form--label">@lang('Minimum Age')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="max_age" type="number" value="{{ @$user->partnerExpectation->max_age }}" min="0" step="any">
                                 <label class="form--label">@lang('Maximum Age')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="min_height" type="number" value="{{ @$user->partnerExpectation->min_height }}" min="0" step="any">
                                 <label class="form--label">@lang('Minimum Height')</label>
                                 <span class="input-group-text">@lang('Feet')</span>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="max_height" type="number" value="{{ @$user->partnerExpectation->max_height }}" min="0" step="any">
                                 <label class="form--label">@lang('Maximum Height')</label>
                                 <span class="input-group-text">@lang('Feet')</span>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="max_weight" type="number" value="{{ @$user->partnerExpectation->max_weight }}" min="0" step="any">
                                 <label class="form--label">@lang('Maximum Weight')</label>
                                 <span class="input-group-text">@lang('KG')</span>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="marital_status">
                                     <option value="" disabled>@lang('Select One')</option>
                                     @foreach ($maritalStatuses as $maritalStatus)
                                         <option value="{{ $maritalStatus->title }}">
                                             {{ __($maritalStatus->title) }}</option>
                                     @endforeach
                                     <option value="0">@lang('Does not matter')</option>
                                 </select>
                                 <label class="form--label">@lang('Marital Status')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="religion">
                                     <option value="">@lang('Select One')</option>
                                     @foreach ($religions as $religion)
                                         <option value="{{ $religion->name }}">{{ __($religion->name) }}</option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Religion')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="complexion" type="text" value="{{ @$user->partnerExpectation->complexion }}">
                                 <label class="form--label">@lang('Complexion')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="smoking_status">
                                     <option value="" disabled>@lang('Smoking Habits')</option>
                                     <option value="0">@lang('Does not matter')</option>
                                     <option value="1">@lang('Smoker')</option>
                                     <option value="2">@lang('Non-smoker')</option>
                                 </select>
                                 <label class="form--label">@lang('Smoking Habits')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="drinking_status">
                                     <option value="" disabled>@lang('Select One')</option>
                                     <option value="0">@lang('Does not matter')</option>
                                     <option value="2">@lang('Restrained')</option>
                                     <option value="1">@lang('Drunker')</option>
                                 </select>
                                 <label class="form--label">@lang('Drinking Status')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="min_degree" type="text" value="{{ @$user->partnerExpectation->min_degree }}">
                                 <label class="form--label">@lang('Minimum Degree')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="profession" type="text" value="{{ @$user->partnerExpectation->profession }}">
                                 <label class="form--label">@lang('Profession')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <select class="form-control form--control select2-auto-tokenize" name="language[]" multiple="multiple">
                                     @if (@$user->partnerExpectation)
                                         @foreach (@$user->partnerExpectation->language as $language)
                                             <option value="{{ $language }}" selected>{{ $language }}</option>
                                         @endforeach
                                     @endif
                                 </select>
                                 <label class="form--label">@lang('Languages')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="personality" type="text" value="{{ @$user->partnerExpectation->personality }}">
                                 <label class="form--label">@lang('Personality')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="financial_condition" type="text" value="{{ @$user->partnerExpectation->financial_condition }}">
                                 <label class="form--label">@lang('Financial Condition')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="family_position" type="text" value="{{ @$user->partnerExpectation->family_position }}">
                                 <label class="form--label">@lang('Family Position')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <button class="btn btn--base w-100 mt-0" type="submit">@lang('Submit')</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- Partner Expectation end-->

 @push('script')
     <script>
         "use strict";

         if (!$('.datepicker-here').val()) {
             $('.datepicker-here').datepicker({
                 autoClose: true,
             });
         }

         $('.skip-btn').on('click', function() {
             $('.info-form').submit();
         });

         let partnerExpForm = $('.partner-expectation-form');
         let religion = "{{ @$user->partnerExpectation->religion }}";
         let gender = "{{ @$user->partnerExpectation->gender }}";
         let maritalStatus = "{{ @$user->partnerExpectation->marital_status }}";
         let smokingStatus = "{{ @$user->partnerExpectation->smoking_status }}";
         let drinkingStatus = "{{ @$user->partnerExpectation->drinking_status }}";
         let country = "{{ @$user->partnerExpectation->country }}";

         partnerExpForm.find('[name=religion]').val(religion);
         partnerExpForm.find('[name=gender]').val(gender);
         partnerExpForm.find('[name=marital_status]').val(maritalStatus);
         partnerExpForm.find('[name=smoking_status]').val(smokingStatus);
         partnerExpForm.find('[name=drinking_status]').val(drinkingStatus);
         partnerExpForm.find('[name=country]').val(country);
     </script>
 @endpush
