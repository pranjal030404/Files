@if (@$member->partnerExpectation)
    <div class="col-md-6">
        <div class="search__right-details">
            <div class="row member-details">
                <label class="col-5"><span>@lang('Religion')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->religion ? __($member->partnerExpectation->religion) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Caste')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->caste ? __($member->partnerExpectation->caste) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Marital Status')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->marital_status ? __($member->partnerExpectation->marital_status) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Country')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->country ? __($member->partnerExpectation->country) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Minimum Age')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->min_age)
                        {{ $member->partnerExpectation->min_age }}
                        @lang('years')
                    @else
                        @lang('N/A')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Minimum Height')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->min_height)
                        {{ $member->partnerExpectation->min_height }}
                        @lang('Ft.')
                    @else
                        @lang('N/A')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Maximum Age')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->max_age)
                        {{ $member->partnerExpectation->max_age }}
                        @lang('years')
                    @else
                        @lang('N/A')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Maximum Height')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->max_height)
                        {{ $member->partnerExpectation->max_height }}
                        @lang('Ft.')
                    @else
                        @lang('N/A')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Maximum Weight')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->max_weight)
                        {{ $member->partnerExpectation->max_weight }}
                        @lang('KG')
                    @else
                        @lang('N/A')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Language')</span>
                </label>
                <span class="col-7">
                    @if (@$member->partnerExpectation)
                        @if (count($member->partnerExpectation->language))
                            {{ implode(', ', $member->partnerExpectation->language) }}
                        @else
                            @lang('N/A')
                        @endif
                    @else
                        @lang('N/A')
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="search__right-details">
            <div class="row member-details">
                <label class="col-5"><span>@lang('Minimum Degree')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->min_degree ? __($member->partnerExpectation->min_degree) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Profession')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->profession ? __($member->partnerExpectation->profession) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Smoking Habits')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->smoking_status == 0)
                        @lang('Does not matter')
                    @elseif($member->partnerExpectation->smoking_status == 1)
                        @lang('Smoker')
                    @elseif($member->partnerExpectation->smoking_status == 2)
                        @lang('Non smoker')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Drinking Status')</span>
                </label>
                <span class="col-7">
                    @if ($member->partnerExpectation->drinking_status == 0)
                        @lang('Does not matter')
                    @elseif($member->partnerExpectation->drinking_status == 1)
                        @lang('Drunker')
                    @elseif($member->partnerExpectation->drinking_status == 2)
                        @lang('Restranied / Non-drunker')
                    @endif
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Personality')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->personality ? __($member->partnerExpectation->personality) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Financial Condition')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->financial_condition ? __($member->partnerExpectation->financial_condition) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('Family Position')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->family_position ? __($member->partnerExpectation->family_position) : 'N/A' }}
                </span>
            </div>
            <div class="row member-details">
                <label class="col-5"><span>@lang('General Requirement')</span>
                </label>
                <span class="col-7">
                    {{ $member->partnerExpectation->family_position ? __($member->partnerExpectation->family_position) : 'N/A' }}
                </span>
            </div>
        </div>
    </div>
@else
    <div class="col-md-12">
        <div class="empty-table text-center">
            <div class="empty-table__icon">
                <i class="las la-frown"></i>
            </div>
            <h6 class="empty-table__text mt-1">
                {{ __($emptyMessage) }}</h6>
        </div>
    </div>
@endif
