@extends('admin')

@section('section')
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Formato de edición</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="default-color">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Formato de edción</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row bootstrap-iso">

            <div class="col-xl-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title" style="text-transform: none !important;">Editar la información de {{ $user->name.' '.$user->middleName.' '.$user->lastName }}</h5>
                        <form id="formulario" method="post" action="{{ route('actualizarInfoUsuario', $user) }}" class="form-horizontal"
                            autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label class="control-label" for="name">Nombre</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->name }}" class="form-control" id="name" name="name" placeholder="Ej. Juan"
                                        required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="middleName">Apellido Paterno</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->middleName }}" class="form-control" id="middleName" name="middleName"
                                        placeholder="Ej. Martinez" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="lastName">Apellido Materno</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->lastName }}" class="form-control" id="lastName" name="lastName"
                                        placeholder="Ej. Garcia" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->email }}" class="form-control" id="email" name="email"
                                        placeholder="nombre@correo.com" required />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label" for="phone">Teléfono</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->phone }}" class="form-control" id="phone" name="phone" placeholder=""
                                        required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="birthday">Fecha de nacimiento</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->birthday }}" class="form-control" id="birthday" name="birthday"
                                        placeholder="Fecha de nacimiento" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">CURP</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->CURP }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="CURP" name="CURP" placeholder=""
                                        required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">NSS</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->NSS }}" class="form-control" id="NSS" name="NSS" placeholder="" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">RFC</label>
                                <div class="mb-2">
                                    <input type="text" value="{{ $user->RFC }}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="RFC" name="RFC" placeholder="" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Editar usuario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>



@endsection



@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />


        <style>
        #formulario .error {
    color: red;
}

</style>

@endpush

@push('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script>
        @if (Session::has('success'))
            swal(
            'Registro guardado con éxito',
            'El usuario fue registrado con éxito, se le envió un correo con la información para accesar.',
            'success',
            'Cerrar'
            )
        @endif


        $.validator.addMethod("RFC", function(value, element) {
            if (value !== '') {
                var patt = new RegExp("^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$");
                return patt.test(value);
            } else {
                return false;
            }
        }, "Ingrese un RFC valido");
        $.validator.addMethod("CURP", function(value, element) {
            if (value !== '') {
                var patt = new RegExp(
                    "^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$"
                    );
                return patt.test(value);
            } else {
                return false;
            }
        }, "Ingrese una CURP valido");


        $("#formulario").validate({
            messages: {
                name: "Este campo es necesario",
                middleName: "Este campo es necesario",
                lastName: "Este campo es necesario",
                email: "Este campo es necesario",
                phone: "Este campo es necesario",
                birthday: "Este campo es necesario",
                RFC: "Este campo es necesario",
                CURP: "Este campo es necesario",
                NSS: "Este campo es necesario"
            },
            rules: {
                RFC: {
                    RFC: true
                },
                CURP: {
                    CURP: true
                },
            },
            errorElement: "em",
            errorPlacement: function(error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
            }
        });


        $(document).ready(function() {
            var date_input = $('input[name="birthday"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        })
    </script>

@endpush



