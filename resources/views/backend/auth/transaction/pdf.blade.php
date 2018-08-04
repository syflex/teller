@extends ('backend.layouts.pdf')

@section('content')
<div class="card">
    <div class="card-body">        

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
