@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.package.global.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Image Upload Limit') <small class="text--info">(@lang('Enter -1 for unlimited image upload'))</small> </label>
                                    <input class="form-control" type="number" name="image_upload_limit" required value="{{ @$general->global_package->image_upload_limit }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Free Profile Show Limit')<small class="text--info">(@lang('Enter -1 for unlimited image upload'))</small></label>
                                    <input class="form-control" type="number" name="contact_view_limit" required value="{{ @$general->global_package->contact_view_limit }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Free Interest Express Limit')<small class="text--info">(@lang('Enter -1 for unlimited image upload'))</small></label>
                                    <input class="form-control" type="number" name="interest_express_limit" required value="{{ @$general->global_package->interest_express_limit }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Per Contact Show Charge')</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" step="any" name="contact_view_charge" required value="{{ @$general->global_package->profile_show_charge }}">
                                        <div class="input-group-text">{{ __(gs('cur_text')) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Per Interest Express Charge')</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" step="any" name="interest_express_charge" required value="{{ @$general->global_package->interest_express_charge }}">
                                        <div class="input-group-text">{{ __(gs('cur_text')) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
