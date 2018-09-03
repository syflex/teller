@extends('frontend.layouts.app')

@section('title', app_name() . ' | '.__('navs.general.home'))

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-home"></i> {{ __('navs.general.home') }}
                </div>
                <div class="card-body">
                    {{ __('strings.frontend.welcome_to', ['place' => app_name()]) }}
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mb-4">
        <div class="col">
        <div class="card">
        <div class="card-header">
            <i class="fas fa-user"></i> Check account balance
        </div>
        <div class="card-body">
        <div class="row mt-4 mb-4">
                    <div class="col text-center">
                        <form action="{{ url('admin/auth/transaction/get/user') }}" method="GET" onsubmit="return InsertViaAjax();" id="ajax-form-submit">  
                            <div class="form-group">
                                <label for="">Account Number</label>
                                <input type="text" name="title" id="title" placeholder="Account Number eg(000000)" class="form-control text-center" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Check account balance</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
        <div class="text-center" id="success">

        </div> 
    </div>
        </div><!--col-->
    </div><!--row-->

    <script>

function InsertViaAjax() { 
 var form = $("#ajax-form-submit");

  // Give the loading icon when data is being submitted
  $("#success").val('loading...');

  var account = $("#title").val();

  //Run Ajax

  $.ajax({           
      type:"GET",
      url:"{{url('get/balance')}}/"+account,
        success: function(data) {         
        //   console.log(data);
         $("#success").html('Your current balnce id ' + data.wallet).delay(12000).fadeOut();
          $("#title").val('');
      }
  });

// To Stop the loading of page after a button is clicked
return false;
}
    </script>
@endsection
