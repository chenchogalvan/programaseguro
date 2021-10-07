@extends('admin')

@section('section')
<div class="content-wrapper">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Completar datos</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="index.html" class="default-color">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active">Completar datos</li>
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
                    <form action="{{ route('completarInfo') }}" id="formulario" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                            <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Fecha de nacimiento" required />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">RFC</label>
                            <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" id="examRFCpleInputEmail1"
                                aria-describedby="emailHelp" placeholder="" name="RFC" required>
                            <small id="emailHelp" class="form-text text-muted">Si desconoces tu RFC, da clic <a href="https://www.sat.gob.mx/aplicacion/operacion/31274/consulta-tu-clave-de-rfc-mediante-curp"
                                    target="_blank">aquí</a> para consultar.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">N° IMSS</label>
                            <input type="text" class="form-control" id="NSS"
                                aria-describedby="emailHelp" placeholder="" name="NSS" required>
                            <small id="emailHelp" class="form-text text-muted">Si desconoces tu N° del IMSS, da clic <a href="https://serviciosdigitales.imss.gob.mx/gestionAsegurados-web-externo/asignacionNSS;JSESSIONIDASEGEXTERNO=xbmya4uU6REpD9GD9f6lb0SK39a0Bg7fiRfyqeWqIc4V4xLkmF4W!-1399856305"
                                    target="_blank">aquí</a> para consultar.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">CURP</label>
                            <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" id="CURP"
                                aria-describedby="emailHelp" placeholder="" name="CURP" required>
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



</div><!-- main content wrapper end-->
@endsection


    @push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />


        <style>
        #formulario .error {
    color: red;
}

</style>

    @push('js')
    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        !function(a){a.fn.datepicker.dates.es={days:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],daysShort:["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"],daysMin:["Do","Lu","Ma","Mi","Ju","Vi","Sa"],months:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],monthsShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],today:"Hoy",monthsTitle:"Meses",clear:"Borrar",weekStart:1,format:"dd/mm/yyyy"}}(jQuery);
    </script>

    <script>
        @if (Session::has('success'))
            swal(
            'Registro guardado con éxito',
            'El usuario fue registrado con éxito, se le envió un correo con la información para accesar.',
            'suuccess',
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
                birthday: "Revisa que el formato sea el correcto o no esté vacío.",
                RFC: "Revisa que el formato sea el correcto o que no esté vacío.",
                CURP: "Revisa que el formato sea el correcto o que no esté vacío.",
                NSS: "Recuerda ingresar los 11 dígitos de tu seguro del IMSS o que no este vacío."
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

</body>

</html>
