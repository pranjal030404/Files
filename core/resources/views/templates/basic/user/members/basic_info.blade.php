<div class="col-md-6">
    <div class="search__right-details">
        <div class="row member-details">
            <label class="col-5"><span>@lang('Age')</span>
            </label>
            <span class="col-7">
               @php echo $member->age() @endphp
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Blood Group')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->physicalAttributes->blood_group) ?? __('N/A') }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Height')</span>
            </label>
            <span class="col-7">
                {{ @$member->physicalAttributes->height ? __(@$member->physicalAttributes->height) . ' Ft.' : 'N/A' }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Religion')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->basicInfo->religion ?? 'N/A') }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Languages')</span>
            </label>
            <span class="col-7">
                @if (@$member->basicInfo)
                    @if (count($member->basicInfo->language))
                        {{ implode(', ', $member->basicInfo->language) }}
                    @else
                        @lang('N/A')
                    @endif
                @else
                    @lang('N/A')
                @endif
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Eye Color')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->physicalAttributes->eye_color ?? 'N/A') }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Hair Color')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->physicalAttributes->hair_color ?? 'N/A') }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Disability')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->physicalAttributes->disability ?? 'N/A') }}
            </span>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="search__right-details">
        <div class="row member-details">
            <label class="col-5"><span>@lang('Profession')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->basicInfo->profession ?? 'N/A') }}</span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Complexion')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->physicalAttributes->complexion ?? 'N/A') }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Present Address')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->basicInfo->present_address->city) }}
                @if (@$member->basicInfo->present_address->city)
                    ,
                @endif
                {{ __(@$member->basicInfo->present_address->country) }}
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5">
                <span>@lang('Permanent Address')</span>
            </label>
            <span class="col-7">
                @if (@$member->basicInfo->permanent_address)
                    {{ __(@$member->basicInfo->permanent_address->city) }}
                    @if (@$member->basicInfo->permanent_address->city)
                        ,
                    @endif
                    {{ __(@$member->basicInfo->permanent_address->country) }}
                @else
                    @lang('N/A')
                @endif
            </span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Father\'s Name')</span>
            </label>
            <span
                class="col-7">{{ __(@$member->family->father_name ?? 'N/A') }}</span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Father\'s Profession')</span>
            </label>
            <span
                class="col-7">{{ __(@$member->family->father_profession ?? 'N/A') }}</span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Mother\'s Name')</span>
            </label>
            <span class="col-7">
                {{ __(@$member->family->mother_name ?? 'N/A') }}</span>
        </div>
        <div class="row member-details">
            <label class="col-5"><span>@lang('Mother\'s Profession')</span>
            </label>
            <span
                class="col-7">{{ __(@$member->family->mother_profession ?? 'N/A') }}</span>
        </div>
    </div>
</div>
