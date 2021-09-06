<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Programa Seguro - Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="/css/style.css" />

</head>

<body>

    <div class="wrapper">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->


        <!--=================================
 header start-->

        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="/"><img style="height: 50px !important;"
                        src="https://demoswhy.com/programaseguro/wp-content/uploads/2021/06/programa-seguro.jpg"
                        alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img style="height: 50px !important;"
                        src="https://demoswhy.com/programaseguro/wp-content/uploads/2021/06/programa-seguro.jpg"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                {{-- <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li> --}}
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                {{-- <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li> --}}
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge badge-danger notification-status"> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notificaciones</strong>
                            <span class="badge badge-pill badge-warning">01</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Tu suscripción está proxima a vencer </a>
                        {{-- <a href="#" class="dropdown-item">New invoice received <small
                                class="float-right text-muted time">22 mins</small> </a>
                        <a href="#" class="dropdown-item">Server error report<small
                                class="float-right text-muted time">7 hrs</small> </a>
                        <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                                days</small> </a>
                        <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                                days</small> </a> --}}
                    </div>
                </li>
                {{-- <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big">
                        <div class="dropdown-header">
                            <strong>Quick Links</strong>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i>
                                <h5>New Task</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i>
                                <h5>Assign Task</h5>
                            </a>
                        </div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i>
                                <h5>Add Orders</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i>
                                <h5>New Orders</h5>
                            </a>
                        </div>
                    </div>
                </li> --}}
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="/images/profile-avatar.jpg" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a> --}}
                        {{-- <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a> --}}
                        <a class="dropdown-item" href="{{ route('perfil') }}"><i class="text-warning ti-user"></i>Perfil</a>
                        {{-- <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span
                                class="badge badge-info">6</span> </a> --}}
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a> --}}
                        <a class="dropdown-item" class="text-danger ti-unlock" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="text-danger ti-unlock"></i>Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->

        <!--=================================
 Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar start-->
                <div class="side-menu-fixed">
                    <div class="scrollbar side-menu-bg">
                        <ul class="nav navbar-nav side-menu" id="sidebarnav">
                            <!-- menu item Dashboard-->
                            <li>
                                <a href="{{ route('dashboard') }}" data-toggle="collapse" data-target="#dashboard">
                                    <div class="pull-left"><i class="ti-home"></i><span
                                            class="right-nav-text">Inicio</span></div>
                                    <div class="pull-right"></div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                            <!-- menu title -->
                            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Opciones </li>

                            <!-- menu item chat-->
                            <li>
                                <a href="{{ route('pagos') }}"><i class="ti-comments"></i><span
                                        class="right-nav-text">Pagos
                                    </span></a>
                            </li>

                            <li>
                                <a href="#"><i class="ti-comments"></i><span class="right-nav-text">Menu de soporte
                                    </span></a>
                            </li>

                            <li>
                                <a href="{{ route('perfil') }}"><i class="ti-comments"></i><span
                                        class="right-nav-text">Configurar perfil
                                    </span></a>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- Left Sidebar End-->

                <!--=================================
wrapper -->

                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Dashboard</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                    <li class="breadcrumb-item"><a href="index.html" class="default-color">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- widgets -->
                    <div class="row">
                        <div class="col-xl-6 mb-30">
                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <h5 class="card-title">Completar información</h5>
                                    <form action="{{ route('completarInfo') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="" name="birthday">
                                            <small id="emailHelp" class="form-text text-muted"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">RFC</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="" name="RFC">
                                            <small id="emailHelp" class="form-text text-muted">Si desconoces tu RFC, da clic <a href="https://www.sat.gob.mx/aplicacion/operacion/31274/consulta-tu-clave-de-rfc-mediante-curp"
                                                    target="_blank">aquí</a> para consultar.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">N° IMSS</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="" name="NSS">
                                            <small id="emailHelp" class="form-text text-muted">Si desconoces tu N° del IMSS, da clic <a href="https://serviciosdigitales.imss.gob.mx/gestionAsegurados-web-externo/asignacionNSS;JSESSIONIDASEGEXTERNO=xbmya4uU6REpD9GD9f6lb0SK39a0Bg7fiRfyqeWqIc4V4xLkmF4W!-1399856305"
                                                    target="_blank">aquí</a> para consultar.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CURP</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="" name="CURP">
                                            <small id="emailHelp" class="form-text text-muted">Si desconoces tu CURP, da clic <a href="https://www.gob.mx/curp/"
                                                    target="_blank">aquí</a> para consultar.</small>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar información</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Orders Status widgets-->




                    <!--=================================
 wrapper -->

                    <!--=================================
 footer -->

                    {{-- <footer class="bg-white p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center text-md-left">
                                    <script>
                                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                                    </script></span>. <a
                                            href="#"> Programa seguro </a> All Rights Reserved. </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="text-center text-md-right">
                                    <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
                                    <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
                                    <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
                                </ul>
                            </div>
                        </div>
                    </footer> --}}
                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>

    <!--=================================
 footer -->



    <!--=================================
 jquery -->

    <!-- jquery -->
    <script src="/js/jquery-3.3.1.min.js"></script>

    <!-- plugins-jquery -->
    <script src="/js/plugins-jquery.js"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = '/js/';
    </script>

    <!-- chart -->
    <script src="/js/chart-init.js"></script>

    <!-- calendar -->
    <script src="/js/calendar.init.js"></script>

    <!-- charts sparkline -->
    <script src="/js/sparkline.init.js"></script>

    <!-- charts morris -->
    <script src="/js/morris.init.js"></script>

    <!-- datepicker -->
    <script src="/js/datepicker.js"></script>

    <!-- sweetalert2 -->
    <script src="/js/sweetalert2.js"></script>

    <!-- toastr -->
    <script src="/js/toastr.js"></script>

    <!-- validation -->
    <script src="/js/validation.js"></script>

    <!-- lobilist -->
    <script src="/js/lobilist.js"></script>

    <!-- custom -->
    <script src="/js/custom.js"></script>

</body>

</html>
