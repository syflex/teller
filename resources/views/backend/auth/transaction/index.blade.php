@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('labels.backend.access.users.management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.users.management') }} <small class="text-muted">{{ __('labels.backend.access.users.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.auth.user.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('Full Name') }}</th>
                            <th>{{ __('Transaction Id') }}</th>
                            <th>{{ __('Transaction Type') }}</th>
                            <th>{{ __('Before Transaction') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('After Transaction') }}</th>
                            <th>{{ __('Charge') }}</th>
                            <th>{{ __('Officer') }}</th>
                            @role('isAdmin')
                            <th>{{ __('labels.general.actions') }}</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->user['first_name'] }} {{ $transaction->user['last_name'] }}</td>
                                <td>{{ $transaction->transID }}</td>
                                <td>
                                    <span class="text-info">{{ $transaction->trans_type }}</span>
                                </td>
                                <td>{!! $transaction->balance_before !!}</td>
                                <td>{!! $transaction->amount !!}</td>
                                <td>{!! $transaction->balance_after !!}</td>
                                <td>{!! $transaction->charge !!}</td>
                                <td>{{ $logged_in_user->first_name }} {{ $logged_in_user->last_name }}</td>
                                @role('isAdmin')
                                <td>                                  
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>                                   
                                </td>
                                @endrole
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $transactions->total() !!} {{ trans_choice('Transactions', $transactions->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $transactions->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
