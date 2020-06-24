<!-- - var menuBorder = true-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Quản lý tài khoản</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <!-- <link href="{{ asset('app-assets/vendors/css/vendors.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/vendors/css/ui/prism.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/vendors/css/forms/toggle/switchery.min.css') }}" rel="stylesheet"> -->
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <!-- <link href="{{ asset('app-assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/colors.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/components.css') }}" rel="stylesheet"> -->
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <!-- <link href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/pages/page-users.css') }}" rel="stylesheet"> -->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
    <!-- END: Custom CSS-->
    <!-- NEW -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/main.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<!-- <body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns"> -->
<body class="hold-transition skin-blue sidebar-mini">

    @guest
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END: Content-->
    @else
    <!-- BEGIN: Header-->        
        <header class="main-header">
            <a href="https://vltk.com.vn" class="logo">
                <span class="logo-mini"><b>A</b>LT</span>
                <span class="logo-lg"><img src="{{ asset('assets/images/logo.png') }}"></span>
            </a>
            <nav class="navbar navbar-static-top">
                <div class="box-home">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    
                    <a href="#" class="mt-menu"><i class="fa fa-home"></i>Trang Chủ</a>
                    <div class="search-top">
                        <form><input type="text" placeholder="Tìm Kiếm" class="form-control"></form>
                    </div>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->cAccName }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">                                    
                                </li>                                
                                <li class="user-footer">
                                    <div class="pull-left">                                        
                                        <a class="btn btn-default btn-flat" href="{{ route('users.edit', Auth::user()->id) }}">
                                        <i class="feather icon-user"></i> Edit Profile
                                    </a>
                                    </div>
                                    <div class="pull-right">                                        
                                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            <i class="feather icon-power"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>                        
                    </ul>
                </div>
            </nav>
        </header>        
        <!-- END: Header-->
        <!-- BEGIN: Main Menu-->
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Alexander Pierce</p>
                        <a href="#" class="text-warning"><i class="fa fa-circle text-warning"></i> 12506 xu</a>
                        <a class="text-logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="feather icon-power"></i>
                            {{ __('Thoát') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>                        
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">                    
                    <li class="active"><a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa fa-user"></i> <span>Thông tin cá nhân</span></a></li>
                    <li class="">
                        <a href="{{ route('users.edit', Auth::user()->id) }}"><i class="fa fa-user"></i><span>Sửa thông tin cá nhân</span></a>
                    </li>
                    <li class=""><a href="{{ route('password_c1.users.edit', Auth::user()->cAccName) }}"><i class="fa fa-lock"></i> <span>Đổi mật khẩu cấp 1</span></a></li>
                    <li class=""><a href="{{ route('password_c2.users.edit', Auth::user()->cAccName) }}"><i class="fa fa-lock"></i> <span>Đổi mật khẩu cấp 2</span></a></li>                    
                    <li class=""><a href="{{ route('email.users.edit', Auth::user()->cAccName) }}"><i class="fa fa-envelope-o"></i> <span>Đổi Email</span></a></li>
                    <li class=""><a href="{{ route('phone.users.edit', Auth::user()->cAccName) }}"><i class="fa fa-phone"></i> <span>Đổi SĐT</span></a></li>
                    <li class=""><a href="{{ route('lichsunaptien') }}"><i class="fa fa-clock-o"></i> <span>Lịch sử nạp tiền</span></a></li>
                    <li class=""><a href="{{ route('lichsuruttien') }}"><i class="fa fa-clock-o"></i> <span>Lịch sử rút tiền</span></a></li>
                </ul>
            </section>
        </aside>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->        
        <div class="content-wrapper">
            <div class="vl-bg">
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>
        <!-- END: Content-->
    @endguest

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Vendor JS-->
    <!-- <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script> -->
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="{{ asset('app-assets/vendors/js/ui/prism.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/page-users.js') }}"></script> -->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <!-- <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script> -->
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="{{ asset('app-assets/js/scripts/pages/app-invoice.js') }}"></script> -->
    <!-- END: Page JS-->

    <!-- NEW -->
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Sparkline -->
    <script src=" {{ asset('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/page-users.js') }}"></script>
</body>
<!-- END: Body-->

</html>
