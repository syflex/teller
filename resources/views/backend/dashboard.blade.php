@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')



            <div class="card">
                <div class="card-header">
                    <strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>                   
            </div><!--card-->
            </div>
       


<div class="row">
<div class="col-sm-6 col-md-3">
<div class="card text-white bg-info">
<div class="card-body">
<div class="h1 text-muted text-right mb-4">
<i class="icon-people"></i>
</div>
<div class="text-value"><h1>{{$allUsers}}</h1></div>
<small class="text-muted text-uppercase font-weight-bold">User</small>   
</div>
    <div class="card-footer px-3 py-2">
        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#">
            <span class="small font-weight-bold text-dark">View Details</span>
            <i class="text-dark fa fa-angle-right"></i>
        </a>
    </div>
</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="card text-white bg-success">
<div class="card-body">
<div class="h1 text-muted text-right mb-4">
<i class="icon-user-follow"></i>
</div>
<div class="text-value"><h1>{{$allTransactions}}</h1></div>
<small class="text-muted text-uppercase font-weight-bold">All Transactions</small>
</div>
    <div class="card-footer px-3 py-2">
        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#">
            <span class="small font-weight-bold text-dark">View Details</span>
            <i class="text-dark fa fa-angle-right"></i>
        </a>
    </div>
</div>
</div>

<div class="col-sm-6 col-md-3">
<div class="card text-white bg-warning">
<div class="card-body">
<div class="h1 text-muted text-right mb-4">
<i class="icon-basket-loaded"></i>
</div>
<div class="text-value"><h1>₦ {{number_format($totalTransactions, 2, '.', ',') }}</h1></div>
<small class="text-muted text-uppercase font-weight-bold">Total Amount Transacted</small>
</div>
    <div class="card-footer px-3 py-2">
        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#">
            <span class="small font-weight-bold text-dark">View Details</span>
            <i class="text-dark fa fa-angle-right"></i>
        </a>
    </div>
</div>
</div>

 @if($logged_in_user->isAdmin())
<div class="col-sm-6 col-md-3">
<div class="card text-white bg-primary">
<div class="card-body">
<div class="h1 text-muted text-right mb-4">
<i class="icon-pie-chart"></i>
</div>
<div class="text-value"><h1>₦ {{number_format($totalAmount, 2, '.', ',') }}</h1></div>
<small class="text-muted text-uppercase font-weight-bold">Total in wallet</small>
</div>
    <div class="card-footer px-3 py-2">
        <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="#">
            <span class="small font-weight-bold text-dark">View Details</span>
            <i class="text-dark fa fa-angle-right"></i>
        </a>
    </div>
</div>
</div>
@endif

</div>


@endsection
