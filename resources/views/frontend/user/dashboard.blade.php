@extends('frontend.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> {{ __('navs.frontend.dashboard') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-4 order-1 order-sm-2  mb-4">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        {{ $logged_in_user->name }}<br/>
                                    </h4>
                                    <h4 class="card-title">
                                        {{ $logged_in_user->ac_number }}<br/>
                                    </h4>

                                    <p class="card-text">
                                        <small>
                                            <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                            <i class="fas fa-calendar-check"></i> {{ __('strings.frontend.general.joined') }} {{ $logged_in_user->created_at->timezone(get_user_timezone())->format('F jS, Y') }}
                                        </small>
                                    </p>

                                    <p class="card-text">

                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> {{ __('navs.frontend.user.account') }}
                                        </a>
                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> {{ __('Fund Account') }}
                                        </a>

                                        @can('view backend')
                                            &nbsp;<a href="{{ route ('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-user-secret"></i> {{ __('navs.frontend.user.administration') }}
                                            </a>
                                        @endcan
                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fas fa-user-circle"></i> {{ __('Pay merchant') }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="card mb-">
                                <div class="card-header">Current Account Balance</div>
                                <div class="card-body">
                                    <small class="card-title">Wallet Balance</small>
                                    <h1 class="card-text">₦ {{number_format($logged_in_user->wallet, 2, '.', ',') }}</h1>
                                </div>
                            </div><!--card-->
                        </div><!--col-md-4-->

                        <div class="col-md-8 order-2 order-sm-1">

                            {{--<div class="row">--}}
                                {{--<div class="col">--}}
                                    {{--<div class="card mb-4">--}}
                                        {{--<div class="card-header">--}}
                                            {{--Item--}}
                                        {{--</div><!--card-header-->--}}

                                        {{--<div class="card-body">--}}
                                            {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non qui facilis deleniti expedita fuga ipsum numquam aperiam itaque cum maxime.--}}
                                        {{--</div><!--card-body-->--}}
                                    {{--</div><!--card-->--}}
                                {{--</div><!--col-md-6-->--}}
                            {{--</div><!--row-->--}}


                            <div class="card  mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="card-title mb-0">
                                                {{ __('My Transaction history') }}
                                            </h4>
                                        </div><!--col-->

                                    </div><!--row-->

                                    @if($transactions)
                                    <div class="row mt-3">
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Transaction Id') }}</th>
                                                        <th>{{ __('Type') }}</th>
                                                        <th>{{ __('Before') }}</th>
                                                        <th>{{ __('Amount') }}</th>
                                                        <th>{{ __('After') }}</th>
                                                        <th>{{ __('Officer') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($transactions as $transaction)
                                                        <tr>
                                                            <td>{{ $transaction->transID }}</td>
                                                            <td>
                                                                @if($transaction->trans_type == 'credit') <span class="badge badge-success">{{ $transaction->trans_type }}</span>
                                                                @elseif($transaction->trans_type == 'debit') <span class="badge badge-danger">{{ $transaction->trans_type }}</span>
                                                                @endif
                                                            </td>
                                                            <td>₦ {{number_format($transaction->balance_before, 2, '.', ',')}}</td>
                                                            <td>₦ {{number_format($transaction->amount, 2, '.', ',')}}</td>
                                                            <td>₦ {{number_format($transaction->balance_after, 2, '.', ',')}}</td>
                                                            <td>{{ $logged_in_user->last_name }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!--col-->
                                    </div><!--row-->
                                    @endif

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


                            <div class="card  mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="card-title mb-0">
                                                {{ __('My Customers Transaction') }}
                                            </h4>
                                        </div><!--col-->

                                    </div><!--row-->


                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __('Name') }}</th>
                                                            <th>{{ __('Account') }}</th>
                                                            <th>{{ __('Transaction Id') }}</th>
                                                            <th>{{ __('Type') }}</th>
                                                            <th>{{ __('Before') }}</th>
                                                            <th>{{ __('Amount') }}</th>
                                                            <th>{{ __('After') }}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($officer_transactions as $transaction)
                                                            <tr>
                                                                <td>{{ $transaction->user['last_name'] }}</td>
                                                                <td>{{ $transaction->user['ac_number'] }}</td>
                                                                <td>{{ $transaction->transID }}</td>
                                                                <td>
                                                                    @if($transaction->trans_type == 'credit') <span class="badge badge-success">{{ $transaction->trans_type }}</span>
                                                                    @elseif($transaction->trans_type == 'debit') <span class="badge badge-danger">{{ $transaction->trans_type }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>₦ {{number_format($transaction->balance_before, 2, '.', ',')}}</td>
                                                                <td>₦ {{number_format($transaction->amount, 2, '.', ',')}}</td>
                                                                <td>₦ {{number_format($transaction->balance_after, 2, '.', ',')}}</td>
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


                            </div><!--row-->
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
