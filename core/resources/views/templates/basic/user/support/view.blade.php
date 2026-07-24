@extends($activeTemplate . 'layouts.' . $layout)
@section('content')
    @if ($layout == 'frontend')
        <div class="section">
            <div class="container">
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card custom--card">
                <div class="card-header card-header-bg d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 mt-0">
                        @php echo $myTicket->statusBadge; @endphp
                        <span class="ticket-title">[@lang('Ticket')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}</span>
                    </h6>
                    @if ($myTicket->status != 3 && $myTicket->user)
                        <button class="btn btn-danger close-button btn-sm confirmationBtn" data-action="{{ route('ticket.close', $myTicket->id) }}" data-question="@lang('Are you sure to close this ticket?')" type="button"><i class="fa fa-lg fa-times-circle"></i>
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" class="disableSubmission" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-between gy-4">
                            <div class="col-md-12">
                                <div class="input--group">
                                    <textarea name="message" class="form-control form--control" rows="4" required>{{ old('message') }}</textarea>
                                    <label class="form--label">@lang('Message')</label>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <button type="button" class="btn btn-dark btn-sm addAttachment mb-2"> <i class="fas fa-plus"></i> @lang('Add Attachment') </button>
                                <p class="mb-2"><span class="text--small text--info">@lang('Max 5 files can be uploaded | Maximum upload size is ' . convertToReadableSize(ini_get('upload_max_filesize')) . ' | Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx')</span></p>
                                <div class="row fileUploadsContainer gy-3">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn--base w-100 mb-2" type="submit"><i class="la la-fw la-lg la-reply"></i> @lang('Reply')</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    @forelse($messages as $message)
                        @if ($message->admin_id == 0)
                            <div class="row border-base border-radius-5 my-3 mx-2 border py-3">
                                <div class="col-md-3 border-end text-end">
                                    <h5 class="my-3">{{ $message->ticket->fullname }}</h5>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-muted fw-bold my-3">
                                        @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ h:i a') }}
                                    </p>
                                    <p>{{ $message->message }}</p>
                                    @if ($message->attachments->count() > 0)
                                        <div class="mt-2">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('ticket.download', encrypt($image->id)) }}"><i class="fa-regular fa-file"></i> @lang('Attachment')
                                                    {{ ++$k }} </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row border-warning border-radius-5 my-3 mx-2 border py-3" style="background-color: #ffd96729">
                                <div class="col-md-3 border-end text-end">
                                    <h5 class="my-3">{{ $message->admin->name }}</h5>
                                    <p class="lead text-muted">@lang('Staff')</p>
                                </div>
                                <div class="col-md-9">
                                    <p class="text-muted fw-bold my-3">
                                        @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ h:i a') }}
                                    </p>
                                    <p>{{ $message->message }}</p>
                                    @if ($message->attachments->count() > 0)
                                        <div class="mt-2">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('ticket.download', encrypt($image->id)) }}"><i class="fa-regular fa-file"></i> @lang('Attachment')
                                                    {{ ++$k }} </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="empty-message text-center">
                            <img src="{{ asset('assets/images/empty_list.png') }}" alt="empty">
                            <h5 class="text-muted">@lang('No replies found here!')</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if ($layout == 'frontend')
        </div>
        </div>
    @endif

    <x-confirmation-modal />
@endsection
@push('style')
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }

        .reply-bg {
            background-color: #ffd96729
        }

        .empty-message img {
            width: 120px;
            margin-bottom: 15px;
        }

        .border-radius-5 {
            border-radius: 5px;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addAttachment').on('click', function() {
                fileAdded++;
                if (fileAdded == 5) {
                    $(this).attr('disabled', true)
                }
                $(".fileUploadsContainer").append(`
                    <div class="col-lg-4 col-md-12 removeFileInput">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="file" name="attachments[]" class="form-control form--control" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx" required>
                                <button type="button" class="input-group-text bg--danger border-0 removeFile"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                `)
            });
            $(document).on('click', '.removeFile', function() {
                $('.addAttachment').removeAttr('disabled', true)
                fileAdded--;
                $(this).closest('.removeFileInput').remove();
            });
        })(jQuery);
    </script>
@endpush
