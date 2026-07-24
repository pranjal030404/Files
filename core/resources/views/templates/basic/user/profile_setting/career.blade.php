<!-- Career Information -->
<div class="public-profile__accordion accordion custom--accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-careerInfo">
            <button class="accordion-button collapsed" data-bs-target="#panelsStayOpen-collapseCareerInfo" data-bs-toggle="collapse" type="button" aria-expanded="false" aria-controls="panelsStayOpen-collapseCareerInfo">
                @lang('Career Information')
            </button>
        </h2>
        <div class="accordion-collapse collapse" id="panelsStayOpen-collapseCareerInfo" aria-labelledby="panelsStayOpen-careerInfo">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-12 pb-4 text-end">
                        <button class="btn btn-sm btn--base btnAddCareer mt-0" data-action="{{ route('user.career.update') }}" data-title="@lang('Add Career Information')">
                            <i class="las la-plus"> @lang('Add New')</i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive--md">
                            <table class="custom--table table table">
                                @if ($user->careerInfo->count())
                                    <thead>
                                        <tr>
                                            <th>@lang('S.N')</th>
                                            <th>@lang('Company')</th>
                                            <th>@lang('Designation')</th>
                                            <th>@lang('Start')</th>
                                            <th>@lang('End')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                @endif
                                <tbody>
                                    @forelse ($user->careerInfo as $career)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ __($career->company) }}</td>
                                            <td>{{ __($career->designation) }}</td>
                                            <td>{{ $career->start }}</td>
                                            <td>{{ $career->end ?? __('Running') }}
                                            </td>
                                            <td>
                                                <button class="icon-btn btn--info btnEditCareer" data-action="{{ route('user.career.update', $career->id) }}" data-bs-toggle="tooltip" data-career="{{ $career }}" data-title="@lang('Update Career Information')" type="button" title="@lang('Edit')">
                                                    <i class="la la-edit"></i>
                                                </button>
                                                <button class="icon-btn btn--danger confirmationBtn" data-action="{{ route('user.career.delete', $career->id) }}" data-bs-toggle="tooltip" data-question="@lang('Are your sure, you want to delete this career information?')" title="@lang('Delete')">
                                                    <i class="las la-trash-alt"></i>
                                                </button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Career Modal -->
<div class="modal custom--modal fade" id="careerModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-sm-12">
                            <div class="input--group">
                                <input class="form-control form--control" name="company" type="text" required>
                                <label class="form--label">@lang('Company')</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input--group">
                                <input class="form-control form--control" name="designation" type="text" required>
                                <label class="form--label">@lang('Designation')</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input--group">
                                <input class="datepicker-here form-control form--control" name="start" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="text">
                                <label class="form--label">@lang('Starting Year')</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input--group">
                                <input class="datepicker-here form-control form--control" name="end" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="text">
                                <label class="form--label">@lang('Ending Year')</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-confirmation-modal />
<!-- Career Information end-->
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/datepicker.en.js') }}"></script>
@endpush

@push('style')
    <style>
        .datepicker {
            z-index: 9999;
        }
    </style>
@endpush

@push('script')
    <script>
        "use strict";

        $('.btnEditCareer').on('click', function() {
            let modal = $('#careerModal');
            let title = $(this).data('title');
            let action = $(this).data('action');
            let career = $(this).data('career');

            modal.find('.modal-title').text(title);
            modal.find('form').attr('action', action);
            modal.find('[name=company]').val(career.company);
            modal.find('[name=designation]').val(career.designation);
            modal.find('[name=start]').val(career.start);
            modal.find('[name=end]').val(career.end);

            modal.modal('show');
        });

        $('.btnAddCareer').on('click', function() {
            let modal = $('#careerModal');
            let title = $(this).data('title');
            let action = $(this).data('action');

            modal.find('.modal-title').text(title);
            modal.find('form').attr('action', action);

            modal.modal('show');
        });

        $('#careerModal').on('hidden.bs.modal', function(event) {
            $(this).find('form').trigger("reset");

        })
    </script>
@endpush
