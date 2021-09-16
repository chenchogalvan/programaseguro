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


        <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-color #f2f2f2;">
            <div class="container">
                @yield('content')

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
