<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Hello, world!</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
</head>

<body>

    <body class="bg-light">

        <div class="container">
            <main>
                <div class="py-5 text-center">

                </div>

                <div class="row g-5">
                    <div class="col-md-7 col-lg-12">
                        <h4 class="mb-3">Formulario de registro</h4>
                        <form class="needs-validation" method="POST" action="{{ route('guardarInfo') }}" novalidate
                            autocomplete="off">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <label for="firstName" class="form-label">Nombre(s)</label>
                                    <input type="text" name="name" class="form-control" id="firstName" placeholder=""
                                        required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="middleName" class="form-label">Apellido paterno</label>
                                    <input type="text" name="middleName" class="form-control" id="middleName"
                                        placeholder="" required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Apellido materno</label>
                                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder=""
                                        required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="username" class="form-label">Fecha de nacimiento</label>
                                    <div class="input-group has-validation" id="sandbox-container">
                                        <input type="text" class="form-control" id="birthday" name="birthday"
                                            placeholder="" required>
                                        <div class="invalid-feedback">
                                            Este campo es obligatorio
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="CURP" class="form-label">CURP <span class="text-muted">Si desconoces tu
                                            CURP, da clic <a href="https://www.gob.mx/curp/" target="_blank">aquí</a>
                                            para consultar.</span></label>
                                    <input type="text" class="form-control" id="CURP" name="CURP" placeholder=""
                                        required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">N° IMSS <span class="text-muted">Si
                                            desconoces tu N° del IMSS, da clic <a
                                                href="https://serviciosdigitales.imss.gob.mx/gestionAsegurados-web-externo/asignacionNSS;JSESSIONIDASEGEXTERNO=xbmya4uU6REpD9GD9f6lb0SK39a0Bg7fiRfyqeWqIc4V4xLkmF4W!-1399856305"
                                                target="_blank">aquí</a> para consultar.</span></label>
                                    <input type="text" class="form-control" id="NSS" name="NSS" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address2" class="form-label">RFC <span class="text-muted">Si desconoces
                                            tu RFC, da clic <a
                                                href="https://www.sat.gob.mx/aplicacion/operacion/31274/consulta-tu-clave-de-rfc-mediante-curp"
                                                target="_blank">aquí</a> para consultar.</span> </label>
                                    <input type="text" class="form-control" id="RFC" name="RFC" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="country" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder=""
                                        required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder=""
                                        required>
                                    <div class="invalid-feedback">
                                        Este campo es obligatorio
                                    </div>
                                </div>

                            </div>

                            <hr class="my-4">

                            <div class="row g-3" style="margin-bottom:50px;">

                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Las contraseñas deben ser iguales</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                </div>

                            </div>






                            <button class="w-100 btn btn-primary btn-lg" style="margin-bottom:50px;"
                                type="submit">Continuar</button>
                        </form>
                    </div>
                </div>
            </main>


        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')
                var password = document.querySelector("#password");
                var password2 = document.querySelector("#password2");

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
                integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $('#sandbox-container input').datepicker({
                startView: 2,
                language: "es"
            });
        </script>
    </body>

</html>



{{-- Leyenda para CURP --}}
