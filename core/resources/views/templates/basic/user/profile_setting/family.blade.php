 <!-- Family Information -->
 <div class="public-profile__accordion accordion custom--accordion" id="accordionPanelsStayOpenExample">
     <div class="accordion-item">
         <h2 class="accordion-header" id="panelsStayOpen-familyInfo">
             <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFamilyInfo" type="button" aria-expanded="false" aria-controls="panelsStayOpen-collapseFamilyInfo">
                 @lang('Family Information')
             </button>
         </h2>
         <div class="accordion-collapse collapse" id="panelsStayOpen-collapseFamilyInfo" aria-labelledby="panelsStayOpen-familyInfo">
             <div class="accordion-body">
                 <form class="family-info-form" action="" method="POST" autocomplete="off">
                     @csrf
                     <input name="method" type="hidden" value="familyInfo">
                     <div class="row gy-4">
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="father_name" type="text" value="{{ @$user->family->father_name }}" required>
                                 <label class="form--label">@lang('Father\'s Name')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="father_profession" type="text" value="{{ @$user->family->father_profession }}">
                                 <label class="form--label">@lang('Father\'s Profession')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="father_contact" type="number" value="{{ @$user->family->father_contact }}" min="0">
                                 <label class="form--label">@lang('Fahter\'s Contact')</label>
                             </div>
                         </div>
                         <div class="col-sm-12">
                             <div class="input--group">
                                 <input class="form-control form--control" name="mother_name" type="text" value="{{ @$user->family->mother_name }}" required>
                                 <label class="form--label">@lang('Mother\'s Name')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="mother_profession" type="text" value="{{ @$user->family->mother_profession }}">
                                 <label class="form--label">@lang('Mother\'s Profession')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="mother_contact" type="number" value="{{ @$user->family->mother_contact }}" min="0">
                                 <label class="form--label">@lang('Mother\'s Contact')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="total_brother" type="number" value="{{ @$user->family->total_brother }}" min="0">
                                 <label class="form--label">@lang('Total Brother')</label>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="input--group">
                                 <input class="form-control form--control" name="total_sister" type="number" value="{{ @$user->family->total_sister }}" min="0">
                                 <label class="form--label">@lang('Total Sister')</label>
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
 <!-- Family Information end-->
