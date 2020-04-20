<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Airline</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" type="image/png" href="{{asset('assets/images/fav_ico.png')}}">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{asset('assets/css/components.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- Daterange picker -->
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    
  <!-- jQuery 2.2.3 -->
  <script src="{{asset('assets/admin/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
  <!-- Bootstrap 3.3.6 -->
  <script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
  
  <!-- DataTables -->
  <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
  <script src="{{asset('assets/admin/plugins/datatables/dataTables.bootstrap.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
  <!-- AdminLTE App -->
  <script src="{{asset('assets/admin/dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('assets/admin/dist/js/demo.js')}}"></script>
  <script src="{{asset('assets/admin/js/jquery.validate.min.js')}}"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{url('admin')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      {{-- <span class="logo-mini"><b>S</b>earch</span> --}}
      <!-- logo for regular state and mobile devices -->
      {{-- <span class="logo-lg"><b>Admin</b></span> --}}
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="">
            <a href="#" class="dropdown-toggle">
              <span class="hidden-xs">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>
            </a>
          </li>
          <li class="">
            <a href="{{url('logout')}}" class="dropdown-toggle" >
            <i class="fa fa-sign-out"></i><span class="hidden-xs">Logout</span>
            </a>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

  @inject('admin_helper', 'App\Services\AdminViewHelper')
  @php     
    $menu_name = $admin_helper->getAdminMenuName();
    $user = ($menu_name == 'users' || $menu_name == 'roles' ) ? true :false;
  @endphp
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li><a href="{{url('/')}}"><i class="fa fa-dollar"></i> <span>PUSH REQ</span></a></li>
        @if(Auth::user()->role == 1)
          <li class="treeview {{$user ? 'active' : ''}}">
            <a href="#">
              <i class="fa fa-edit"></i> <span>CRM</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu {{$user ? 'menu-open' : ''}}">
              <li @if($menu_name == 'users') class="active" @endif><a href="{{url('/admin/users')}}"><i class="fa fa-circle-o"></i> User Management</a></li>
              <li @if($menu_name == 'visit') class="active" @endif><a href="{{url('/admin/visit')}}"><i class="fa fa-circle-o"></i> Visit Report</a></li>
            </ul>
          </li>
        @endif
        <li><a href="{{url('/MRO')}}"><i class="fa fa-dollar"></i> <span>MRO MANAGEMENT</span></a></li>
        <li><a href="{{url('/Airline')}}"><i class="fa fa-dollar"></i> <span>AIRLINE MANAGEMENT</span></a></li>
        @if(Auth::user()->role == 1)
        <li><a href="{{url('/upload')}}"><i class="fa fa-dollar"></i> <span>UPLOAD FLEET</span></a></li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  @yield("contents")

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 <a href="#">Search</a>.</strong> All rights
    reserved.
  </footer>

 
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


