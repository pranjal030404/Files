@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="table-responsive--md">
            <table class="custom--table table">
                @if ($ignoredLists->count())
                    <thead>
                    <tr>
                        <th>@lang('S.N')</th>
                        <th>@lang('Name')</th>
                        <th>@lang('Age')</th>
                        <th>@lang('Religion')</th>
                        <th>@lang('Country')</th>
                        <th>@lang('Action')</th>
                    </tr>
                    </thead>
                @endif
                <tbody>
                @forelse ($ignoredLists as $ignoredList)
                    <tr>
                        <td>
                            {{ $ignoredLists->firstItem() + $loop->index }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="user user--sm">
                                    <img class="user__img" src="{{ $ignoredList->profile->profilePicture() }}" alt="@lang('Image')" />
                                </div>
                                <h6 class="user__text d-inline-block mt-0 mb-0">
                                    <a href="{{ route('user.member.profile.public', $ignoredList->profile->id) }}">{{ __($ignoredList->profile->firstname == '' ? $ignoredList->profile->username : $ignoredList->profile->fullname) }}</a>
                                </h6>
                            </div>
                        </td>
                        <td>{{ $ignoredList->profile->age() }}</td>
                        <td>{{ __(@$ignoredList->profile->basicInfo->religion ?? 'N/A') }}</td>
                        <td>{{ __(@$ignoredList->profile->basicInfo->present_address->country ?? 'N/A') }}</td>
                        <td>
                            <a class="icon-anchor btn--danger remove" data-action="{{ route('user.ignored.remove', $ignoredList->id) }}" data-bs-title="@lang('Remove from ignored list')" data-bs-toggle="tooltip" href="javascript:void(0)"><i class="las la-times"></i></a>
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

        @if ($ignoredLists->hasPages())
            <div class="mt-3 text-center">
                {{ paginateLinks($ignoredLists) }}
            </div>
        @endif
    </div>
@endsection

@push('script')
    <script>
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.remove').on('click', function() {
            let url = $(this).data('action');
            let table = $(this).parents('table');
            let tr = $(this).parents('tr');

            $.ajax({
                type: "post",
                url: url,
                success: function(response) {
                    if (response.success) {
                        notify('success', response.success);
                        tr.remove();
                        if (!table.find('tbody').find('tr').length) {
                            table.find('thead').remove();
                            table.find('tbody').append(`
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
                        `);
                        }
                    } else {
                        notify('error', response.error);
                    }
                }
            });
        });
    </script>
@endpush
