<!-- Express Interest Modal -->
<div aria-hidden="true" class="modal custom--modal fade" id="interestExpressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Express Interest!')</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            @php
                $user = auth()->user();
            @endphp
            @if ($user)
                <form action="{{ route('user.express.interest') }}" class="express-interest-form" method="post">
                    @csrf
                    <div class="modal-body">
                        <input name="interesting_id" type="hidden">
                        @if (checkValidityPeriod($user->limitation) && ($user->limitation?->interest_express_limit == -1 || $user->limitation?->interest_express_limit))
                            <div class="text-center">
                                <p class="fw-bold">@lang('Remaining Express Interest') : <span class="remainingInterest"></span></p>
                                @if ($user->limitation->interest_express_limit != -1)
                                    <small class="text--danger">@lang('"N.B: Expressing interest will cost 1 from your remaining interests"')</small>
                                @endif
                            </div>
                        @else
                            <div class="text-center">
                                @if ($user->limitation)
                                    @if (!checkValidityPeriod($user->limitation))
                                        <p class="fw-bold">@lang('Your package has been expired') <span
                                                  class="fw-600">{{ diffForHumans($user->limitation->expire_date ?? '') }}</span>
                                        </p>
                                    @else
                                        <p class="fw-bold">@lang('Remaining Express Interest') : <span class="remainingInterest"></span>
                                        </p>
                                    @endif
                                @endif
                                @if (gs('default_package_id'))
                                    <small>@lang('Purchase package from ')
                                        <a class="text--base" href="{{ route('packages') }}">@lang('packages')</a>
                                    </small>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if (checkValidityPeriod($user->limitation) && ($user->limitation?->interest_express_limit == -1 || $user->limitation?->interest_express_limit))
                            <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                        @else
                            <button class="btn btn--dark btn-sm" data-bs-dismiss="modal"
                                    type="button">@lang('Close')</button>
                        @endif
                    </div>
                </form>
            @else
                <div class="modal-body">
                    <p class="text-center">@lang('Please login first')</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn--dark btn--sm" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('script')
    <script>
        "use strict";

        $(document).on('click', '.interestExpressBtn', function() {
            let modal = $('#interestExpressModal');
            let interestingId = $(this).data('interesting_id');
            modal.find('[name=interesting_id]').val(interestingId);
            let route = "{{ auth()->check() ? route('user.interest.limit') : '#' }}";
            $.get(route,
                function(data) {
                    if (data == '-1') {
                        modal.find('.remainingInterest').text('Unlimited');
                    } else
                        modal.find('.remainingInterest').text(data);
                }
            );
            modal.modal('show');
        });
    </script>
@endpush
