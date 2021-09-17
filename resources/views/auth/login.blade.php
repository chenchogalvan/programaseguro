<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="Programa seguro - Inicia sesión" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Programa seguro - Inicia sesión</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico" />

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
            <img src="/images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->

        <!--=================================
 login-->

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-color #f2f2f2;">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    @if (Session::has('success'))
                    <div class="col-md-8">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Registro exitoso</h4>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    </div>

                    @endif

                </div>
                <div class="row justify-content-center no-gutters vertical-align">
                    <div class="col-lg-4 col-md-6 login-fancy-bg bg"
                        style="background-image: url(https://demoswhy.com/programaseguro/wp-content/uploads/2021/07/490748-PH5A0U-472-e1626939846635.jpg);">
                        <div class="login-fancy">
                            <h1 class="text-white mb-20">Programa Seguro</h1>
                            <p class="mb-20 text-white">Inicia sesión y disfruta de todos los beneficios de pertenecer a
                                Programa Seguro.</p>
                            <ul class="list-unstyled  pos-bot pb-30">
                                {{-- <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li> --}}
                                {{-- <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">Inicia sesión</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name">Correo* </label>
                                    <input id="name" class="web form-control" type="text"
                                        placeholder="nombre@correo.com" name="email">
                                </div>
                                @error('email')

                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">Contraseña* </label>
                                    <input id="Password" class="Password form-control" type="password"
                                        placeholder="*******" name="password">
                                </div>
                                @error('password')

                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                                {{-- <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <input type="checkbox" class="form-control" name="two" id="two" />
                                    <label for="two"> Remember me</label>
                                    <a href="password-recovery.html" class="float-right">Forgot Password?</a>
                                </div>
                            </div> --}}
                                <button class="button">Enviar datos <i class="fa fa-check"></i></button>
                                <p class="mt-20 mb-0">¿Aun no tienes una cuenta? <a href="/register"> Crea una</a>
                                <p>Olvidaste tus datos de inicio? <a href="/password/reset">Restablece tu contraseña </a></p>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
 login-->

    </div>



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
