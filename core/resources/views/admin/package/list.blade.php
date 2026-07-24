@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th>@lang('S.N.')</th>
                                <th>@lang('name')</th>
                                <th>@lang('Interest Express Limit')</th>
                                <th>@lang('Profile Show Limit')</th>
                                <th>@lang('Image Upload Limit')</th>
                                <th>@lang('Validity Period')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($packages as $package)
                                <tr>
                                    <td>{{ $packages->firstItem() + $loop->index }}</td>
                                    <td>
                                        <span class="fw-bold">{{ __($package->name) }}</span>
                                    </td>
                                    <td>
                                        @if ($package->interest_express_limit == -1)
                                            <span class="badge badge--dark">@lang('Unlimited')</span>
                                        @else
                                            {{ $package->interest_express_limit }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->contact_view_limit == -1)
                                            <span class="badge badge--dark">@lang('Unlimited')</span>
                                        @else
                                            {{ $package->contact_view_limit }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->image_upload_limit == -1)
                                            <span class="badge badge--dark">@lang('Unlimited')</span>
                                        @else
                                            {{ $package->image_upload_limit }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($package->validity_period == -1)
                                            <span class="badge badge--dark">@lang('Unlimited')</span>
                                        @else
                                            {{ $package->validity_period }} @lang('Days')
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ showAmount($package->price) }} </span>
                                    </td>
                                    <td>
                                        @php echo $package->statusBadge @endphp
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-wrap gap-1">
                                            <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Update Package')" data-resource="{{ $package }}" type="button"><i class="la la-pencil"></i>@lang('Edit')</button>

                                            @if ($package->status)
                                                <button type="button" class="btn btn-outline--danger confirmationBtn" data-action="{{ route('admin.package.update.status', $package->id) }}" data-question="@lang('Are you sure that you want to disable this package?')"> <i class="las la-eye-slash"></i>@lang('Disable')</button>
                                            @else
                                                <button type="button" class="btn btn-outline--success confirmationBtn" data-action="{{ route('admin.package.update.status', $package->id) }}" data-question="@lang('Are you sure that you want to enable this package?')"> <i class="las la-eye"></i>@lang('Enable')</button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $emptyMessage }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($packages->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($packages) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Add METHOD MODAL --}}
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.package.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label> @lang('Name')</label>
                            <input class="form-control" name="name" required type="text">
                        </div>
                        <div class="form-group">
                            <label> @lang('Interest Express Limit')<small class="text-muted">(@lang('Enter -1 for unlimited period'))</small></label>
                            <input class="form-control" min="-1" name="interest_express_limit" required type="number">
                        </div>
                        <div class="form-group">
                            <label> @lang('Profile Show Limit')<small class="text-muted">(@lang('Enter -1 for unlimited period'))</small></label>
                            <input class="form-control" min="-1" name="contact_view_limit" required type="number">
                        </div>
                        <div class="form-group">
                            <label> @lang('Image Upload Limit')<small class="text-muted">(@lang('Enter -1 for unlimited period'))</small></label>
                            <input class="form-control" min="-1" name="image_upload_limit" required type="number">
                        </div>
                        <div class="form-group">
                            <label> @lang('Validity Period ')<small class="text-muted">(@lang('In Days, Enter -1 for unlimited period'))</small> </label>
                            <input class="form-control" min="-1" name="validity_period" required type="number">
                        </div>
                        <div class="form-group">
                            <label> @lang('Price')</label>
                            <div class="input-group">
                                <input class="form-control" min="0" name="price" required step="any" type="number">
                                <div class="input-group-text">
                                    {{ __(gs('cur_text')) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add New Package')" type="button">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush
