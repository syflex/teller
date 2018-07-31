@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>{{ __('strings.backend.dashboard.welcome') }} {{ $logged_in_user->name }}!</strong>
                    @if($logged_in_user->hasRole('officer'))
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.auth.officer.create.user') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New"><i class="fas fa-plus-circle"></i></a>
                    </div><!--btn-toolbar-->
                    @endif
                    @if($logged_in_user->hasRole('officer'))
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{ route('admin.auth.officer.create.user') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Create New"><i class="fas fa-plus-circle"></i>Credit Account</a>
                    </div><!--btn-toolbar-->
                    @endif
                </div><!--card-header-->
                @if($logged_in_user->isAdmin())
                <div class="card-block">
                    {{$allUsers}}   {{$allTransactions}} {{$totalTransactions}} {{$totalAmount}}
                </div><!--card-block-->
                @endif
                <div class="card-block">
                    <!-- {!! __('strings.backend.welcome') !!} -->
                </div><!--card-block-->
                <div class="card-block">
                    <!-- {!! __('strings.backend.welcome') !!} -->
                </div><!--card-block-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
