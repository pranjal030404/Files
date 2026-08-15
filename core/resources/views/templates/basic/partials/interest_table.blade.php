<div class="table-responsive--md">
    <table class="custom--table table">
        @if ($interests->count())
            <thead>
            <tr>
                <th>@lang('S.N')</th>
                <th>@lang('Name')</th>
                <th>@lang('Age')</th>
                <th>@lang('Religion')</th>
                <th>@lang('Caste')</th>
                <th>@lang('Status')</th>
                <th>@lang('Action')</th>
            </tr>
            </thead>
        @endif
        <tbody>
        @forelse ($interests as $interest)
            <tr>
                <td>
                    @if ($pagination == true)
                        {{ $interests->firstItem() + $loop->index }}
                    @else
                        {{ $loop->index + 1 }}
                    @endif
                </td>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <div class="user user--sm">
                            <img class="user__img" src="{{ $interest->profile->profilePicture() }}" alt="@lang('Image')" />
                        </div>
                        <h6 class="user__text d-inline-block mt-0 mb-0">
                            <a href="{{ route('user.member.profile.public', $interest->profile->id) }}">{{ __($interest->profile->fullname) }}</a>
                        </h6>
                    </div>
                </td>
                <td>{{ $interest->profile->age() }}</td>
                <td>{{ __(@$interest->profile->basicInfo->religion ?? 'N/A') }}</td>
                <td>{{ __(@$interest->profile->basicInfo->caste ?? 'N/A') }}</td>
                <td>
                    @php
                        echo $interest->statusBadge;
                    @endphp
                </td>
                <td>
                    @if ($interest->status == Status::ENABLE)
                        <a class="icon-anchor btn--messenger" data-bs-toggle="tooltip" href="{{ route('user.message.index', encrypt($interest->conversation->id)) }}" title="@lang('Message')"><i class="las la-envelope"></i></a>
                    @else
                        <a class="icon-anchor btn--danger" data-bs-toggle="tooltip" href="javascript::void(0)" title="@lang('You can message after accepted the request')"><i class="las la-envelope"></i></a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">
                    <div class="empty-table text-center">
                        <div class="empty-table__icon">
                            <i class="las la-frown"></i>
                        </div>
                        <h6 class="empty-table__text mt-1">{{ __($emptyMessage) }}</h6>
                    </div>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
