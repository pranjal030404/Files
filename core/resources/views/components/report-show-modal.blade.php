<div class="modal custom--modal fade" id="reportShowModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Report!')</h5>
                <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="report-title m-0 text-center"></h5>
                <p class="report-reason"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        "use strict";

        $('.reportedUser').on('click', function() {
            let data = $(this).data();
            let modal = $("#reportShowModal");
            modal.find('.report-title').text(data.report_title);
            modal.find('.report-reason').text(data.report_reason);
            modal.modal('show');
        });
    </script>
@endpush
