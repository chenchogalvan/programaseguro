{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Programa seguro - Registro </title>

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
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div>

        <!--=================================
 preloader -->


        <!--=================================
 register-->

        <section class="height-100vh d-flex align-items-center page-section-ptb login"
            style="background-color:#f2f2f2;">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-4 offset-lg-1 col-md-6 login-fancy-bg bg parallax"
                        style="background-image: url(https://demoswhy.com/programaseguro/wp-content/uploads/2021/07/490748-PH5A0U-472-e1626939846635.jpg);">
                        <div class="login-fancy">
                            <h1 class="text-white mb-20">PROGRAMA <br>SEGURO</h1>
                            <p class="mb-20 text-white">Con Programa Seguro tu familia tendrá acceso a servicios de
                                atención a la salud. Regístrate para obtener todos los beneficios que ofrecemos.</p>
                            <ul class="list-unstyled pos-bot pb-30">
                                {{-- <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li> --}}
                                {{-- <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 bg-white">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">Formato de registro</h3>
                            <form method="POST" action="{{ route('guardarInfo') }}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="section-field mb-20 col-sm-12">
                                        <label class="mb-10" for="fname">Nombre(s) </label>
                                        <input id="fname" class="web form-control" type="text" placeholder="Nombre(s)"
                                            name="name">
                                    </div>
                                    <div class="section-field mb-20 col-sm-6">
                                        <label class="mb-10" for="mname">Apellido paterno </label>
                                        <input id="mname" class="web form-control" type="text"
                                            placeholder="Apellido paterno" name="middleName">
                                    </div>
                                    <div class="section-field mb-20 col-sm-6">
                                        <label class="mb-10" for="lname">Apellido materno </label>
                                        <input id="lname" class="web form-control" type="text"
                                            placeholder="Apellido materno" name="lastName">
                                    </div>
                                </div>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="phone">Teléfono </label>
                                    <input type="phone" placeholder="Teléfono" id="phone" class="form-control"
                                        name="phone">
                                </div>

                                <div class="section-field mb-20">
                                    <label class="mb-10" for="email">Correo* </label>
                                    <input type="email" placeholder="Email*" id="email" class="form-control"
                                        name="email">
                                </div>


                                <div class="section-field mb-20">
                                    <label class="mb-10" for="password">Contraseña* </label>
                                    <input class="Password form-control" id="password" type="password"
                                        placeholder="Password" name="password">
                                </div>
                                {{-- <a href="#" class="button">
                                    <span>Registrarse</span>
                                    <i class="fa fa-check"></i>
                                </a> --}}
                                <button class="button">Enviar datos <i class="fa fa-check"></i></button>

                            </form>


                            <p class="mt-20 mb-0">¿Ya tienes una cuenta? <a href="/login"> Inicia sesión</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
 register-->

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
