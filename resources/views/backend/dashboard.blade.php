@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')



<div class="card">
    <div class="card-header">
        <strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>
        @if($logged_in_user->hasRole('officer'))
            <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                <a href="{{route('admin.auth.officer.create.user')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><svg class="svg-inline--fa fa-plus-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg><!-- <i class="fas fa-plus-circle"></i> --></a>
            </div>
        @else()
            <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                <a href="{{route('admin.auth.user.create')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><svg class="svg-inline--fa fa-plus-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg><!-- <i class="fas fa-plus-circle"></i> --></a>
            </div>
        @endif
    </div><!--card-->
</div>





 <div class="row">

<div class="col-6 col-lg-3">
<div class="card">
<div class="card-body p-3 d-flex align-items-center">
<i class="fa fa-users text-primary font-2xl mr-3"></i>
<div>
<div class="text-value-sm text-primary"><h2>{{$allUsers}}</h2></div>
<div class="text-muted text-uppercase font-weight-bold small mr-5">Users</div>   
</div>
    @if($logged_in_user->hasRole('officer'))
        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
            <a href="{{route('admin.auth.officer.create.user')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><svg class="svg-inline--fa fa-plus-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg><!-- <i class="fas fa-plus-circle"></i> --></a>
        </div>
    @else()
        <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
            <a href="{{route('admin.auth.user.create')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="Create New"><svg class="svg-inline--fa fa-plus-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="plus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg><!-- <i class="fas fa-plus-circle"></i> --></a>
        </div>
    @endif
</div>
<div class="card-footer px-3 py-2">
        @if($logged_in_user->hasRole('officer'))
            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.auth.officer.get.user')}}">
                <span class="small font-weight-bold">View Details</span>
                <i class="fa fa-angle-right"></i>
            </a>
        @else
            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.auth.user.index')}}">
                <span class="small font-weight-bold">View Details</span>
                <i class="fa fa-angle-right"></i>
            </a>
        @endif
</div>
</div>
</div>

<div class="col-6 col-lg-3">
<div class="card">
<div class="card-body p-3 d-flex align-items-center">
<i class="fa fa-laptop text-info font-2xl mr-3"></i>
<div>
<div class="text-value-sm text-info"><h2>{{$allTransactions}}</h2></div>
<div class="text-muted text-uppercase font-weight-bold small">Transactions</div>
</div>
</div>
<div class="card-footer px-3 py-2">
<a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.auth.transaction.index')}}">
            <span class="small font-weight-bold">View Details</span>
            <i class="fa fa-angle-right"></i>
        </a>
</div>
</div>
</div>

<div class="col-6 col-lg-3">
<div class="card">
<div class="card-body p-3 d-flex align-items-center">
<i class="fa fa-moon-o text-warning font-2xl mr-3"></i>
<div>
<div class="text-value-sm text-warning"><h2>₦ {{number_format($totalAmount, 2, '.', ',') }}</h2></div>
<div class="text-muted text-uppercase font-weight-bold small">Total Amount Transacted</div>
</div>
</div>
<div class="card-footer px-3 py-2">
<a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.auth.transaction.index')}}">
            <span class="small font-weight-bold">View Details</span>
            <i class="fa fa-angle-right"></i>
        </a>
</div>
</div>
</div>

@if($logged_in_user->isAdmin())
<div class="col-6 col-lg-3">
<div class="card">
<div class="card-body p-3 d-flex align-items-center">
<i class="fa fa-bell text-danger font-2xl mr-3"></i>
<div>
<div class="text-value-sm text-danger"><h2>₦ {{number_format($totalAmount, 2, '.', ',') }}</h2></div>
<div class="text-muted text-uppercase font-weight-bold small">Total in wallet</div>
</div>
</div>
<div class="card-footer px-3 py-2">
@if($logged_in_user->hasRole('officer'))
            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.auth.officer.get.user')}}">
                <span class="small font-weight-bold">View Details</span>
                <i class="fa fa-angle-right"></i>
            </a>
        @else
            <a class="btn-block text-muted d-flex justify-content-between align-items-center" href="{{route('admin.auth.user.index')}}">
                <span class="small font-weight-bold">View Details</span>
                <i class="fa fa-angle-right"></i>
            </a>
        @endif
</div>
</div>
</div>
@endif
</div>


@endsection
