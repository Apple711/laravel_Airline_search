<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin_Mergetransit</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" type="image/png" href="{{asset('assets/images/fav_ico.png')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/iCheck/square/blue.css')}}">
   
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .register-box {
        width: 760px;
        margin: 35px auto;
    }
    .btn.type_btn{
        padding-left: 2px;
        padding-right: 2px;
    }
    .nav-tabs-custom > .tab-content{
        padding: 15px !important
    }
    .tab-content > .active {
        padding-top: 30px !important;
        }
    #register_form input {
        border: none;
        border-bottom: solid 1px #ccc;
    }
    #register_form input:focus {
        border-bottom: solid 1px #31b0d5;
    }
    #register_form input.has-error{
        border-bottom: solid 1px #f00;
    }
    .help-block {
        padding: 0 10px;

    color: red;
    }
    .ziperror {
        color:red
    }
    .hide_card{display:none;}
    .StripeElement {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

    #card-errors{
        color:red;
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>MERGE</b>TRANSIT</a>
  </div>
  <!-- /.login-logo -->
  <div class="register-box-body">
    <p class="register-box-msg">Register</p>

     @if($status = Session::get("status"))
        <div class="alert alert-info form-group">
            <span class="help-block">
                <strong>{{$status}}</strong>
            </span>
        </div><br>
    @endif

    <form action="{{url('admin/register')}}" method="post" id="register_form" class="reg-form">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control {{ $errors->has('firstname') ? ' has-error' : '' }}" value="{{ old('firstname') }}" 
                    name="firstname" placeholder="First name" autocomplete="off"  required>
                    @if ($errors->has('firstname'))
                        <span class="help-block">{{ $errors->first('firstname') }} </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control {{ $errors->has('lastname') ? ' has-error' : '' }}" value="{{ old('lastname') }}" 
                    name="lastname" placeholder="Last name" autocomplete="off"  required>
                    @if ($errors->has('lastname'))
                        <span class="help-block">{{ $errors->first('lastname') }} </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group has-feedback">
            <input type="text" class="form-control {{ $errors->has('phone') ? ' has-error' : '' }}" value="{{ old('phone') }}" 
            name="phone" placeholder="Phone" autocomplete="off"  required>
            @if ($errors->has('phone'))
                <span class="help-block">{{ $errors->first('phone') }} </span>
            @endif
        </div>
        
        <div class="form-group has-feedback">
            <input type="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" value="{{ old('email') }}" 
            name="email" placeholder="Email" autocomplete="off"  required>
            @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }} </span>
            @endif
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}"
             name="password" placeholder="Password" autocomplete="off"  required>
            @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }} </span>
            @endif
        </div>

        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password" autocomplete="off"  required>
            
        </div>
        <div class="row">
            <div class="col-xs-3">
               
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <button type="submit" id="" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <div class="col-xs-3">
               
                </div>
        <!-- /.col -->
        </div>
    </form>

    <div class="row text-center" style="padding-top:20px">
        <a href="/admin" >I already have an account</a>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('assets/admin/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.validate.min.js')}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr1HliRAne44OuG55a6FOOornx_dHgBjA&libraries=places"></script>
<script src="https://js.stripe.com/v3/"></script>

</body>
</html>
