 <!-- Physical Attributes -->
 <div class="public-profile__accordion accordion custom--accordion" id="accordionPanelsStayOpenExample">
     <div class="accordion-item">
         <h2 class="accordion-header" id="panelsStayOpen-physicalAttr">
             <button class="accordion-button collapsed" data-bs-target="#panelsStayOpen-collapsePhysicalAttr" data-bs-toggle="collapse" type="button" aria-expanded="false" aria-controls="panelsStayOpen-collapsePhysicalAttr">
                 @lang('Physical Attributes')
             </button>
         </h2>
         <div class="accordion-collapse collapse" id="panelsStayOpen-collapsePhysicalAttr" aria-labelledby="panelsStayOpen-physicalAttr">
             <div class="accordion-body">
                 <form class="physical-attr-form" action="" autocomplete="off" method="POST">
                     @csrf

                     <input name="method" type="hidden" value="physicalAttributes">
                     <div class="row gy-4">
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="complexion" type="text" value="{{ @$user->physicalAttributes->complexion }}" required>
                                 <label class="form--label">@lang('Complexion')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="height" type="number" value="{{ @$user->physicalAttributes->height }}" min="0" required step="any">
                                 <label class="form--label">@lang('Height')</label>
                                 <span class="input-group-text">@lang('Feet')</span>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="weight" type="number" value="{{ @$user->physicalAttributes->weight }}" min="0" required step="any">
                                 <label class="form--label">@lang('Weight')</label>
                                 <span class="input-group-text">@lang('KG')</span>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <select class="form-select form-control form--control" name="blood_group">
                                     <option value="">@lang('Select One')</option>
                                     @foreach ($bloodGroups as $blood)
                                         <option value="{{ $blood->name }}">{{ __($blood->name) }}</option>
                                     @endforeach
                                 </select>
                                 <label class="form--label">@lang('Blood Group')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="eye_color" type="text" value="{{ @$user->physicalAttributes->eye_color }}" required>
                                 <label class="form--label">@lang('Eye Color')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="hair_color" type="text" value="{{ @$user->physicalAttributes->hair_color }}" required>
                                 <label class="form--label">@lang('Hair Color')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="disability" type="text" value="{{ @$user->physicalAttributes->disability }}">
                                 <label class="form--label">@lang('Disability')</label>
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
 <!-- Physical Attributes end-->

 @push('script')
     <script>
         "use strict";
         let physicalAttrForm = $('.physical-attr-form');
         let bloodGroup = "{{ @$user->physicalAttributes->blood_group }}";

         physicalAttrForm.find('[name=blood_group]').val(bloodGroup);
     </script>
 @endpush
