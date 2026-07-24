@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Package')</th>
                                <th>@lang('Buying Date')</th>
                                <th>@lang('Amount')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ @$log->user->fullname }}</span>
                                        <br>
                                        <span class="small"> <a href="{{ route('admin.users.detail', $log->user_id) }}"><span>@</span>{{ @$log->user->username }}</a> </span>
                                    </td>

                                    <td>
                                        <span class="fw-bold"> {{ __($log->package->name) }}</span>
                                    </td>

                                    <td>
                                        <span class="fw-bold"> {{ __(showDateTime($log->created_at)) }}</span>
                                    </td>

                                    <td>
                                        <span class="fw-bold">{{ showAmount($log->package_details->price) }} </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($logs->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($logs) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form dateSearch='no' placeholder='Username / Email' />
@endpush
