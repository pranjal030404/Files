@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="table-responsive--md">
            <table class="custom--table table">
                @if ($shortlists->count())
                    <thead>
                        <tr>
                            <th class="text-nowrap">@lang('S.N')</th>
                            <th class="text-nowrap">@lang('Name')</th>
                            <th class="text-nowrap">@lang('Age')</th>
                            <th class="text-nowrap">@lang('Religion')</th>
                            <th class="text-nowrap">@lang('Country')</th>
                            <th class="text-nowrap">@lang('Action')</th>
                        </tr>
                    </thead>
                @endif
                <tbody>
                    @forelse ($shortlists as $shortlist)
                        <tr>
                            <td>
                                {{ $shortlists->firstItem() + $loop->index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user user--sm">
                                        <img class="user__img" src="{{ $shortlist->profile->profilePicture() }}"
                                            alt="@lang('Image')" />
                                    </div>
                                    <h6 class="user__text d-inline-block mt-0 mb-0">
                                        <a
                                            href="{{ route('user.member.profile.public', $shortlist->profile_id) }}">{{ __($shortlist->profile->firstname == '' ? $shortlist->profile->username : $shortlist->profile->fullname) }}</a>
                                    </h6>
                                </div>
                            </td>
                            <td>{{ $shortlist->profile->age() }}</td>
                            <td>{{ __(@$shortlist->profile->basicInfo->religion ?? 'N/A') }}</td>
                            <td>{{ __(@$shortlist->profile->basicInfo->present_address->country ?? 'N/A') }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-end gap-2">
                                    @if ($user->interests->where('interesting_id', $shortlist->profile_id)->first())
                                        <a class="icon-anchor btn--info" data-bs-toggle="tooltip" href="javascript:void(0)"
                                            title="@lang('Interest Expressed')"><i class="las la-heart"></i></a>
                                    @elseif($shortlist->profile->interests->where('interesting_id', $user->id)->where('status', 0)->first())
                                        <a class="icon-anchor btn--info" data-bs-toggle="tooltip" href="javascript:void(0)"
                                            title="@lang('Response to Interest')"><i class="las la-heart"></i></a>
                                    @elseif($shortlist->profile->interests->where('interesting_id', $user->id)->where('status', 1)->first())
                                        <a class="icon-anchor btn--info" data-bs-toggle="tooltip" href="javascript:void(0)"
                                            title="@lang('You Accepted Interest')"><i class="las la-heart"></i></a>
                                    @else
                                        <a class="icon-anchor btn--base-two interestExpressBtn" data-bs-toggle="tooltip"
                                            data-interesting_id="{{ $shortlist->profile_id }}" href="javascript:void(0)"
                                            title="@lang('Express Interest')"><i class="las la-heart"></i></a>
                                    @endif

                                    <a class="icon-anchor btn--danger remove"
                                        data-action="{{ route('user.shortlist.remove', $shortlist->id) }}"
                                        href="javascript:void(0)"><i class="las la-trash-alt"></i></a>
                                </div>
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
            @if ($shortlists->hasPages())
                <div class="mt-3">
                    {{ paginateLinks($shortlists) }}
                </div>
            @endif
        </div>
    </div>

    <x-interest-express-modal />
@endsection

@push('breadcrumb-plugins')
    <form action="">
        <div class="input-group">
            <input class="form-control form--control bg-white" name="search" type="text"
                value="{{ request()->search }}">
            <button class="input-group-text btn btn--base" type="submit"><i class="las la-search"></i></button>
        </div>
    </form>
@endpush

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
            let tr = $(this).parents('tr');
            let table = $(this).parents('table');
            $.ajax({
                type: "post",
                url: url,
                success: function(response) {
                    console.log(response);
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

        $('.express-interest-form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let url = $(this).attr('action');
            let modal = $('#interestExpressModal');
            let id = modal.find('[name=interesting_id]').val();
            let button = $(`.interestExpressBtn[data-interesting_id="${id}"]`);
            let td = $(`.interestExpressBtn[data-interesting_id="${id}"]`).parents('td');
            $.ajax({
                type: "post",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    modal.modal('hide');
                    if (response.success) {
                        notify('success', response.success);
                        button.remove();
                        td.prepend(`
                        <a href="javascript:void(0)" class="icon-anchor btn--info" data-bs-toggle="tooltip" title="@lang('Interest Expressed')"><i class="las la-heart"></i></a>
                        `);
                    } else {
                        notify('error', response.error);
                    }
                }
            });
        })
    </script>
@endpush
