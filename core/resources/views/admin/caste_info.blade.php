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
                                <th>@lang('Name')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($castes as $caste)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <span class="fw-bold">{{ __($caste->name) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap justify-content-end gap-1">
                                            <button class="btn btn-outline--primary btn-sm cuModalBtn" data-modal_title="@lang('Update Caste')" data-resource="{{ $caste }}" type="button">
                                                <i class="las la-pen"></i>@lang('Edit')
                                            </button>
                                            <button class="btn btn-outline--danger btn-sm confirmationBtn" data-action="{{ route('admin.caste.delete', $caste->id) }}" data-question="@lang('Are you sure, you want to delete this caste?')" type="button">
                                                <i class="las la-trash-alt"></i>@lang('Delete')
                                            </button>
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
            </div>
        </div>
    </div>
    <x-confirmation-modal />

    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.caste.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" name="name" placeholder="@lang('Enter new caste')" required type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Caste')" type="button">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush
