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
                    {{ __('Trasaction Management') }} <small class="text-muted">{{ __('transaction list') }}</small>
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
                            @if($logged_in_user->isAdmin())
                            <th>{{ __('labels.general.actions') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->user['first_name'] }} {{ $transaction->user['last_name'] }}</td>
                                <td>{{ $transaction->transID }}</td>
                                <td>
                                   @if($transaction->trans_type == 'credit') <span class="badge badge-success">{{ $transaction->trans_type }}</span>
                                   @elseif($transaction->trans_type == 'debit') <span class="badge badge-danger">{{ $transaction->trans_type }}</span>
                                   @endif
                                </td>                               
                                <td>₦ {{number_format($transaction->balance_before, 2, '.', ',')}}</td>
                                <td>₦ {{number_format($transaction->amount, 2, '.', ',')}}</td>
                                <td>₦ {{number_format($transaction->balance_after, 2, '.', ',')}}</td>
                                <td>₦ {{number_format($transaction->charge, 2, '.', ',')}}</td>
                                <td>{{ $logged_in_user->first_name }} {{ $logged_in_user->last_name }}</td>
                                @if($logged_in_user->isAdmin())
                                <td>                                  
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>   
                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>                                   
                                </td>
                                @endif
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
