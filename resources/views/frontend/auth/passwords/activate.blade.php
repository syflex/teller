@extends('frontend.layouts.app')

@section('title', app_name() . ' | '.__('labels.frontend.passwords.reset_password_box_title'))

@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>
                        {{ __('Activate Account') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="#" method="GET" onsubmit="return myFunction();" id="ajax-form-submit">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ html()->label(__('Activation Token'))->for('token') }}

                                    {{ html()->text('token')
                                        ->class('form-control')
                                        ->placeholder(__('Activation Token'))
                                        ->attribute('maxlength', 191)
                                        ->required()
                                        ->autofocus() }}
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0 clearfix">
                                    <button type="submit" class="btn btn-success btn-sm pull-right">Activate Account</button>
                                </div><!--form-group-->
                            </div><!--col-->
                        </div><!--row-->
                    {{ html()->form()->close() }}
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- col-6 -->
    </div><!-- row -->

    <script>
     


function myFunction() {
 var form = $("#ajax-form-submit");
    window.location = "/account/confirm/"+$("#token").val();
    return false;
}
    </script>
@endsection
