<!-- Report Modal -->
<div aria-hidden="true" class="modal custom--modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Report Member')</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            @auth
                <form action="{{ route('user.report') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input name="complaint_id" type="hidden">
                        <div class="input--group">
                            <input class="form-control form--control" id="title" name="title" required type="text">
                            <label class="form--label" for="title">@lang('Title')</label>
                        </div>
                        <div class="input--group mt-3">
                            <textarea class="form-control form--control" id="reason" name="reason" required></textarea>
                            <label class="form--label" for="reason">@lang('Reason')</label>
                        </div>
                        <div class="input-group mt-3">
                            <div class="form--check">
                                <input {{ old('is_ignored') ? 'checked' : '' }} class="form-check-input" id="is_ignored" name="is_ignored" type="checkbox">
                                <label class="form-check-label" for="is_ignored">@lang('Ignore this profile')</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            @else
                <div class="modal-body">
                    <p class="text-center">@lang('Please login first')</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn--dark" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            @endauth
        </div>
    </div>
</div>
