@extends ('backend.layouts.app')

@section ('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')

<div id="success">
 
 </div>


<form action="{{ url('admin/auth/transaction/get/user') }}" method="GET" onsubmit="return InsertViaAjax();" id="ajax-form-submit">
					<div class="form-group">
						<label for="">Account Number</label>
						<input type="text" name="title" id="title" placeholder="Account Number eg(000000)" class="form-control">
					</div>
 
				
 
					<div class="form-group">
						<button class="btn btn-primary">Search User</button>
					</div>
				</form>

    {{ html()->form('POST', route('admin.auth.transaction.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.access.users.management') }}
                            <small class="text-muted">{{ __('labels.backend.access.users.create') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr />

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('Account Number'))->class('col-md-2 form-control-label')->for('account') }}

                            <div class="col-md-10">
                                {{ html()->text('account')
                                    ->class('form-control')
                                    ->placeholder(__('Account Number'))
                                    ->attribute('maxlength', 8)
                                    ->required()
                                    ->autofocus() 
                                    ->disabled() }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                            <div class="col-md-10">
                                {{ html()->text('first_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() 
                                    ->disabled() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                            <div class="col-md-10">
                                {{ html()->text('last_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                    ->attribute('maxlength', 191)
                                    ->required() 
                                    ->disabled() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Current Balance'))->class('col-md-2 form-control-label')->for('balance') }}

                            <div class="col-md-10">
                                {{ html()->text('balance')
                                    ->class('form-control')
                                    ->placeholder(__('Current Balance'))
                                    ->attribute('maxlength', 191)
                                    ->required() 
                                    ->disabled() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Ammount'))->class('col-md-2 form-control-label')->for('amount') }}

                            <div class="col-md-10">
                                {{ html()->text('amount')
                                    ->class('form-control')
                                    ->placeholder(__('Amount'))
                                    ->attribute('maxlength', 5)
                                    ->required()}}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Transaction Charge'))->class('col-md-2 form-control-label')->for('charge') }}

                            <div class="col-md-10">
                                {{ html()->text('charge')
                                    ->class('form-control')
                                    ->placeholder(__('Transaction Charge'))
                                    ->attribute('maxlength', 5)}}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('Transaction Description'))->class('col-md-2 form-control-label')->for('description') }}

                            <div class="col-md-10">
                                {{ html()->textarea('description')
                                    ->class('form-control')
                                    ->placeholder(__('Transaction Description'))}}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">                          
                            <div class="col-md-10">
                                {{ html()->hidden('id')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">                          
                            <div class="col-md-10">
                                {{ html()->hidden('wallet')
                                    ->class('form-control')
                                    }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">                          
                            <div class="col-md-10">
                                {{ html()->hidden('type')
                                    ->class('form-control')
                                    ->value('debit')}}
                            </div><!--col-->
                        </div><!--form-group-->

                    
                       
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    <script>
    function InsertViaAjax() {
 
    var form = $("#ajax-form-submit");

 

     // Give the loading icon when data is being submitted
     $("#success").val('loading...');

     var account = $("#title").val();
     var desc = $("#description").val();

     //Run Ajax

     $.ajax({           
         type:"GET",
         url:"{{url('admin/auth/transaction/get/user')}}/"+account,
         success: function(data) {
            $("#account").val(data.ac_number);
            $("#first_name").val(data.first_name);
            $("#last_name").val(data.last_name);
            $("#balance").val(data.wallet);
            $("#id").val(data.id);
            $("#wallet").val(data.wallet);
             console.log(data);
            $("#success").html('Inserted into database'+data.ac_number).delay(3000).fadeOut();
         }
     });

 // To Stop the loading of page after a button is clicked
 return false;
}
    </script>
@endsection