@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="table-responsive--md">
        <table class="custom--table table">
            @if (count($purchasedPackages))
                <thead>
                <tr>
                    <th>@lang('Package')</th>
                    <th>@lang('Validity Period')</th>
                    <th>@lang('Price')</th>
                    <th>@lang('Purchase Date')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
                </thead>
            @endif
            <tbody>
            @forelse ($purchasedPackages as $purchasedPackage)
                <tr>
                    <td>
                        <h6 class="user__text mt-0 mb-0"> {{ $purchasedPackage->package_details->name }}</h6>
                    </td>
                    <td>
                        @if ($purchasedPackage->package_details->validity_period > -1)
                            {{ $purchasedPackage->package_details->validity_period }}
                        @else
                            @lang('Unlimited')
                        @endif
                        @lang('Days')
                    </td>
                    <td>
                        {{ showAmount($purchasedPackage->package_details->price) }}
                    </td>
                    <td>{{ showDateTime($purchasedPackage->created_at, 'd M, Y') }}</td>
                    <td>@php echo $purchasedPackage->statusBadge @endphp</td>
                    <td>
                        <button class="btn btn--icon btn--base detailBtn" data-deposit="{{ $purchasedPackage->deposit }}" data-package_details="{{ json_encode($purchasedPackage->package_details) }}"><i class="las la-desktop"></i></button>
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
        @if ($purchasedPackages->hasPages())
            <div class="mt-3 text-center">
                {{ paginateLinks($purchasedPackages) }}
            </div>
        @endif
    </div>

    <div aria-hidden="true" class="modal custom--modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Purchase Details!')</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush payment-details">
                        <li class="list-group-item d-flex justify-content-between flex-wrap gap-2">
                            <small class="fw-bold">@lang('Package')</small>
                            <small class="package-name fw-bold"></small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between flex-wrap gap-2">
                            <small class="fw-bold">@lang('Interest express limit')</small>
                            <small class="interest-express"></small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between flex-wrap gap-2">
                            <small class="fw-bold">@lang('Contact view limit')</small>
                            <small class="contact-view"></small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between flex-wrap gap-2">
                            <small class="fw-bold">@lang('Image upload limit')</small>
                            <small class="image-upload"></small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between flex-wrap gap-2">
                            <small class="fw-bold">@lang('Validity Period')</small>
                            <small class="validity-period fw-bold"></small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between flex-wrap gap-2 ">
                            <small class="fw-bold">@lang('Payment Via')</small>
                            <small class="payment-via"></small>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--dark btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <form action="">
        <div class="input-group">
            <input class="form-control form--control bg-white" name="search" type="text" value="{{ request()->search }}">
            <button class="input-group-text btn btn--base" type="submit"><i class="las la-search"></i></button>
        </div>
    </form>
@endpush

@push('script')
    <script>
        (function($) {
            $('.detailBtn').on('click', function() {
                let packageDetail = $(this).data('package_details');
                let deposit = $(this).data('deposit');
                let modal = $('#detailModal');
                modal.find('.package-name').text(packageDetail.name)
                modal.find('.interest-express').text(parseInt(packageDetail.interest_express_limit) > -1 ? packageDetail.interest_express_limit : `@lang('Unlimited')`)
                modal.find('.contact-view').text(parseInt(packageDetail.contact_view_limit) > -1 ? packageDetail.contact_view_limit : `@lang('Unlimited')`)
                modal.find('.image-upload').text(parseInt(packageDetail.image_upload_limit) > -1 ? packageDetail.image_upload_limit : `@lang('unlimited')`)
                modal.find('.validity-period').text(parseInt(packageDetail.validity_period) > -1 ? packageDetail.validity_period + ` @lang('days')` : `@lang('Unlimited')`)
                modal.find('.payment-via').text(deposit.gateway.name);
                if (deposit.method_code >= 1000) {
                    let ul = modal.find('.payment-details');
                    if (deposit.detail != null && deposit.detail.length > 0) {
                        $.each(deposit.detail, function(i, element) {
                            if (element.type != 'file') {
                                ul.append(`
                                   <li class="list-group-item d-flex justify-content-between flex-wrap gap-2 manual-payment">
                                       <small class="fw-bold">${element.name}</small>
                                       <small class="validity-period fw-bold">${element.value}</small>
                                   </li>
                               `);
                            }
                        });
                    }
                } else {
                    $(document).find('.manual-payment').remove();
                }

                modal.modal('show');
            })
        })(jQuery);
    </script>
@endpush
