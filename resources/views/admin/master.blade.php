<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>BPR LESTARI JATENG</title>
    
    <link rel="stylesheet" href="{{asset ('/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/genosstyle.css')}}">
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand border-bottom" style="background-color: #09839B">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link text-light" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link text-light">@yield('judul')</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-light" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>&nbsp;{{auth()->guard('web')->user()->username}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right text-dark">
                        <a href="{{route('logoutadmin')}}" class="dropdown-item dropdown-footer ">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- SIDEBAR -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- LOGO -->
            <a href="/" class="brand-link">
                <img src="{{ asset('/images/logoputih.png') }} " alt="logo" width="60%"  height="50%"/>
            </a>
           
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset ('/adminlte/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->guard('web')->user()->username}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-database"></i>
                                <p>
                                    Data
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="{{route ('pageuser')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{route ('pagekredit')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Kredit</p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{route ('pagedeposito')}}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Deposito</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>
                                <p>
                                    Report
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                
                            </ul>
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid pt-2" style="min-height: 650px">
        @yield('content')
    </div>
</div>
        <!-- /.content-wrapper -->
<footer class="main-footer" style="background-color: #09839B">
    <strong class="text-light">Admin Panel BPR Lestari jateng &copy; Copyright 2019</strong>
</footer>


</div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{asset ('/adminlte/js/adminlte.js')}}"></script>
    <script src="{{ asset('/js/sweetalert/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
    @yield('script')
</body>

</html>
