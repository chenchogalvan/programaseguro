@extends('admin')

@section('section')
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Formato de alta</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="default-color">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Formato de alta</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row bootstrap-iso">

            <div class="col-xl-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title" style="text-transform: none !important;">Registrar a una persona en
                            Programa Seguro</h5>
                        <form id="formulario" method="post" action="{{ route('saveuser') }}" class="form-horizontal"
                            autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label class="control-label" for="name">Nombre</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ej. Juan"
                                        required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="middleName">Apellido Paterno</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="middleName" name="middleName"
                                        placeholder="Ej. Martinez" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="lastName">Apellido Materno</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="lastName" name="lastName"
                                        placeholder="Ej. Garcia" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="nombre@correo.com" required />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label" for="phone">Teléfono</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder=""
                                        required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="birthday">Fecha de nacimiento</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="birthday" name="birthday"
                                        placeholder="Fecha de nacimiento" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">CURP</label>
                                <div class="mb-2">
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="CURP" name="CURP" placeholder=""
                                        required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">NSS</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="NSS" name="NSS" placeholder="" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">RFC</label>
                                <div class="mb-2">
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" class="form-control" id="RFC" name="RFC" placeholder="" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Dar de
                                    alta</button>
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
            !function(a){a.fn.datepicker.dates.es={days:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],daysShort:["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"],daysMin:["Do","Lu","Ma","Mi","Ju","Vi","Sa"],months:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],monthsShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],today:"Hoy",monthsTitle:"Meses",clear:"Borrar",weekStart:1,format:"dd/mm/yyyy"}}(jQuery);
        </script>

    <script>
        @if (Session::has('success'))
            Swal.fire({
            title: 'Registro guardado con éxito',
            html: 'El usuario fue registrado con éxito, se le envió un correo con la información para accesar.',
            icon: 'success',
            confirmButtonText: 'Cerrar'

            })
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
                name: "Este campo es obligatorio.",
                middleName: "Este campo es obligatorio.",
                lastName: "Este campo es obligatorio.",
                email: "Este campo es obligatorio.",
                phone: "Este campo es obligatorio.",
                birthday: "Revisa que el formato sea el correcto o no esté vacío.",
                RFC: "Revisa que el formato sea el correcto o que no esté vacío.",
                CURP: "Revisa que el formato sea el correcto o que no esté vacío.",
                NSS: "Recuerda ingresar los 11 dígitos de tu seguro del IMSS."
            },
            rules: {
                RFC: {
                    RFC: true,
                    minlength: 13,
                    maxlength: 13
                },
                CURP: {
                    CURP: true
                },
                NSS:{
                    minlength: 11,
                    maxlength: 11
                }
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
                format: 'dd/mm/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
            };
            date_input.datepicker(options);
        })




    </script>

@endpush
