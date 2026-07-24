<!-- Education Information -->
<div class="public-profile__accordion accordion custom--accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-educationInfo">
            <button class="accordion-button collapsed" data-bs-target="#panelsStayOpen-collapseEducationInfo" data-bs-toggle="collapse" type="button" aria-expanded="false" aria-controls="panelsStayOpen-collapseEducationInfo">
                @lang('Education Information')
            </button>
        </h2>
        <div class="accordion-collapse collapse" id="panelsStayOpen-collapseEducationInfo" aria-labelledby="panelsStayOpen-educationInfo">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-12 pb-4 text-end">
                        <button class="btn btn-sm btn--base btnAddEducation mt-0" data-action="{{ route('user.education.update') }}" data-title="@lang('Add Education Information')">
                            <i class="las la-plus"> @lang('Add New')</i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive--md">
                            <table class="custom--table table table">
                                @if ($user->educationInfo->count())
                                    <thead>
                                        <tr>
                                            <th>@lang('S.N')</th>
                                            <th>@lang('Degree')</th>
                                            <th>@lang('Institute')</th>
                                            <th>@lang('Field')</th>
                                            <th>@lang('Result')</th>
                                            <th>@lang('Start')</th>
                                            <th>@lang('End')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                @endif
                                <tbody>
                                    @forelse ($user->educationInfo as $education)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ __($education->degree) }}</td>
                                            <td>{{ __($education->institute) }}</td>
                                            <td>{{ __($education->field_of_study) }}
                                            </td>
                                            <td>{{ $education->result }}
                                            </td>
                                            <td>{{ $education->start }}</td>
                                            <td>{{ $education->end ?? __('Running') }}
                                            </td>
                                            <td>
                                                <button class="icon-btn btn--info btnEditEducation" data-action="{{ route('user.education.update', $education->id) }}" data-bs-toggle="tooltip" data-education="{{ $education }}" data-title="@lang('Update Education Information')" type="button" title="@lang('Edit')">
                                                    <i class="la la-edit"></i>
                                                </button>
                                                <button class="icon-btn btn--danger confirmationBtn" data-action="{{ route('user.education.delete', $education->id) }}" data-bs-toggle="tooltip" data-question="@lang('Are your sure, you want to delete this Education Information?')" title="@lang('Delete')">
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
<div class="modal custom--modal fade" id="educationModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="input--group">
                                <input class="form-control form--control" name="institute" type="text" required>
                                <label class="form--label">@lang('Institute')</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input--group">
                                <input class="form-control form--control" name="degree" type="text" required>
                                <label class="form--label">@lang('Degree')</label>
                            </div>
                        </div>

                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="form-control form--control" name="field_of_study" type="text" required>
                                <label class="form--label">@lang('Field Of Study')</label>
                            </div>
                        </div>

                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="form-control form--control" name="reg_no" type="number">
                                <label class="form--label">@lang('Registration No.')</label>
                            </div>
                        </div>

                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="form-control form--control" name="roll_no" type="number">
                                <label class="form--label">@lang('Roll No.')</label>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="datepicker-here form-control form--control" name="start" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="text" required>
                                <label class="form--label">@lang('Starting Year')</label>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="datepicker-here form-control form--control" name="end" data-date-format="yyyy" data-language='en' data-min-view="years" data-position='top left' data-view="years" type="text">
                                <label class="form--label">@lang('Ending Year')</label>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="form-control form--control" name="result" type="number" min="0" step="any">
                                <label class="form--label">@lang('Result')</label>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="input--group">
                                <input class="form-control form--control" name="out_of" type="number" min="0" step="any">
                                <label class="form--label">@lang('Out Of')</label>
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
<!-- Education Information end-->
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
        $('.btnEditEducation').on('click', function() {
            let modal = $('#educationModal');
            let title = $(this).data('title');
            let action = $(this).data('action');
            let education = $(this).data('education');

            modal.find('.modal-title').text(title);
            modal.find('form').attr('action', action);
            modal.find('[name=degree]').val(education.degree);
            modal.find('[name=institute]').val(education.institute);
            modal.find('[name=field_of_study]').val(education.field_of_study);

            if (education.reg_no != 0) {
                modal.find('[name=reg_no]').val(education.reg_no);
            }
            if (education.roll_no != 0) {
                modal.find('[name=roll_no]').val(education.roll_no);
            }

            modal.find('[name=start]').val(education.start);
            modal.find('[name=end]').val(education.end);
            modal.find('[name=result]').val(education.result);
            modal.find('[name=out_of]').val(education.out_of);

            modal.modal('show');
        });

        $('.btnAddEducation').on('click', function() {
            let modal = $('#educationModal');
            let title = $(this).data('title');
            let action = $(this).data('action');

            modal.find('.modal-title').text(title);
            modal.find('form').attr('action', action);

            modal.modal('show');
        });

        $('#educationModal').on('hidden.bs.modal', function(event) {
            $(this).find('form').trigger("reset");

        })
    </script>
@endpush
