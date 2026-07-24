@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                            <tr>
                                <th>@lang('S.N')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Profile')</th>
                                @if (request()->routeIs('admin.user.interests'))
                                    <th>@lang('Accept Status')</th>
                                @endif
                                @if (request()->routeIs('admin.user.reports'))
                                    <th>@lang('Title')</th>
                                    <th>@lang('Action')</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($profiles as $profile)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $profiles->firstItem() + $loop->index }}</span>
                                    </td>
                                    @if (request()->routeIs('admin.user.reports'))
                                        <td>
                                            <span class="fw-bold">{{ @$profile->reporter->fullname }}</span>
                                            <br>
                                            <span class="small"> <a href="{{ route('admin.users.detail', $profile->user_id) }}"><span>@</span>{{ @$profile->reporter->username }}</a> </span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="fw-bold">{{ @$profile->user->fullname }}</span>
                                            <br>
                                            <span class="small"> <a href="{{ route('admin.users.detail', $profile->user_id) }}"><span>@</span>{{ @$profile->user->username }}</a> </span>
                                        </td>
                                    @endif

                                    <td>
                                        <span class="fw-bold">{{ @$profile->profile->fullname }}</span>
                                        <br>
                                        <span class="small"> <a href="{{ route('admin.users.detail', $profile->profile->id) }}"><span>@</span>{{ @$profile->profile->username }}</a> </span>
                                    </td>

                                    @if (request()->routeIs('admin.user.interests'))
                                        <td>
                                            @php echo $profile->statusBadge @endphp
                                        </td>
                                    @endif
                                    @if (request()->routeIs('admin.user.reports'))
                                        <td>
                                            {{ __($profile->title) }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end flex-wrap gap-2">
                                                <button class="detailBtn btn btn-outline--primary btn-sm" data-reason="{{ __($profile->reason) }}" data-title="{{ __($profile->title) }}"> <i class="las la-desktop"></i>@lang('Detail')</button>

                                                @if ($profile->profile->status == Status::USER_ACTIVE)
                                                    <button class="btn btn-outline--danger userStatus btn-sm" data-user="{{ $profile->profile }}" type="button"><i class="las la-ban"></i>@lang('Ban')</button>
                                                @else
                                                    <button class="btn btn-outline--success userStatus btn-sm" data-user="{{ $profile->profile }}" type="button"><i class="las la-undo"></i>@lang('Unban')</button>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($profiles->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($profiles) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Report!')</h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h5 class="title"></h5>
                    </div>
                    <p class="reason"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userStatusModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="ban-div">
                            <h6 class="mb-2">@lang('If you ban this user he/she won\'t able to access his/her dashboard.')</h6>
                            <div class="form-group">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="reason" required rows="4"></textarea>
                            </div>
                        </div>
                        <div class="banned-div">
                            <p><span>@lang('Ban reason was'):</span></p>
                            <p class="ban-reasn"></p>
                            <h4 class="mt-3 text-center">@lang('Are you sure to unban this user?')</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 ban-div w-100" type="submit">@lang('Submit')</button>
                        <div class="banned-div">
                            <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                            <button class="btn btn--primary" type="submit">@lang('Yes')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex justify-content-end flex-wrap">
        <form class="form-inline" action="" method="GET">
            <div class="input-group justify-content-end">
                <input class="form-control bg--white" name="search" type="text" value="{{ request()->search }}" placeholder="@lang('Search Username')">
                <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
@endpush

@push('script')
    <script>
        (function($q) {
            "use strict";
            $('.detailBtn').on('click', function() {
                let modal = $('#detailModal');
                let title = $(this).data('title');
                let reason = $(this).data('reason');

                modal.find('.title').text(title);
                modal.find('.reason').text(reason);
                modal.modal('show');
            });

            $('.userStatus').on('click', function() {
                let user = $(this).data('user');
                let modal = $('#userStatusModal');

                modal.find('form').attr('action', `{{ route('admin.users.status', '') }}/${user.id}`)

                if (user.status == 1) {
                    modal.find('.modal-title').text('Ban User');
                    modal.find('.banned-div').addClass('d-none');
                    modal.find('[name=reason]').attr('required', true);
                    modal.find('.ban-div').removeClass('d-none');
                } else {
                    modal.find('.modal-title').text('Unban User');
                    modal.find('.banned-div').removeClass('d-none');
                    modal.find('[name=reason]').attr('required', false);
                    modal.find('.ban-div').addClass('d-none');
                    modal.find('.ban-reasn').text(user.ban_reason);
                }

                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
