@extends('admin')


@section('section')
    <div class="content-wrapper profile-page">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Perfil</h4>
                </div>

            </div>
        </div>
        <!-- widgets -->
        <div class="row">

            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <div class="user-bg" style="background: url(/images/userbg.jpg);">
                            <div class="user-info">
                                <div class="row">
                                    <div class="col-lg-6 align-self-center">
                                        <div class="user-dp"><img src="/images/team/user.png" alt=""></div>
                                        <div class="user-detail">
                                            <h2 class="name">{{ Auth::user()->name.' '.Auth::user()->middleName.' '.Auth::user()->lastName }}</h2>
                                            <p class="designation mb-0">- {{ Auth::user()->email }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Orders Status widgets-->

        <div class="row">
            <div class="col-xl-4 mb-30">
                @if (Session::has('successDatos'))
                    <div class="mb-30">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Datos actualizados</h4>
                            <p>Los datos se actualizaron de forma correcta</p>
                        </div>
                    </div>
                @endif
                <div class="card mb-30 about-me">
                    <div class="card-body">
                        <h5 class="card-title"> Información</h5>

                        <div class="btn-group info-drop">
                            {{-- <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button> --}}
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                        class="text-success ti-pencil-alt"></i>
                                    Editar</a>

                            </div>
                        </div>


                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <div class="mb-30">
                                                <h6>{{ Auth::user()->name }}</h6>
                                                <h2>Actualizar datos</h2>
                                                <p>En caso de querer actualizar otro dato, favor de mandar un ticket.</p>
                                            </div>
                                        </div>
                                        {{-- <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario" method="POST" action="{{ route('actualizarInfo') }}">
                                            @csrf
                                            {{-- <div class="form-group">
                                                <label>Correo</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div> --}}

                                            @if ($upago->count() > 0)

                                                <div class="form-group">
                                                    <label>Teléfono</label>
                                                    <input type="hidden" name="pagoAprobado" value="2">
                                                    <input type="number" class="form-control" id="phone" name="phone"
                                                        value="{{ Auth::user()->phone }}" required>
                                                </div>


                                            @else



                                            <input type="hidden" name="pagoAprobado" value="1">



                                                <div class="form-group">
                                                    <label>Teléfono</label>
                                                    <input type="number" class="form-control" id="phone" name="phone"
                                                        value="{{ Auth::user()->phone }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="text" class="form-control" id="birthday" name="birthday"
                                                        value="{{ Auth::user()->birthday }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>N° IMSS</label>
                                                    <input type="number" class="form-control" name="NSS"
                                                        value="{{ Auth::user()->NSS }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>RFC</label>
                                                    <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="RFC" class="form-control" name="RFC"
                                                        value="{{ Auth::user()->RFC }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>CURP</label>
                                                    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" name="CURP"
                                                        value="{{ Auth::user()->CURP }}" required>
                                                </div>
                                            @endif


                                            <button type="submit" class="btn btn-primary">Guardar datos</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled ">
                            <li class="list-item"><span class="text-info ti-star"></span><b>Teléfono:</b>
                                {{ Auth::user()->phone }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>Fecha de nacimiento:</b>
                                {{ Auth::user()->birthday }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>Correo:</b>
                                {{ Auth::user()->email }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>RFC:</b>
                                {{ Auth::user()->RFC }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>N° IMSS:</b>
                                {{ Auth::user()->NSS }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>CURP:</b>
                                {{ Auth::user()->CURP }}
                            </li>





                            <li>
                                <fieldset>
                                    <button class="btn btn-success d-grid" data-toggle="modal"
                                        data-target="#exampleModalCenter">Editar información</button>
                                </fieldset>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xl-8 mb-30">
                <div class="card tickets">
                    <div class="card-body">
                        <h5 class="card-title"> Tickets de ayuda</h5>
                        <!-- action group -->
                        <div class="btn-group info-drop">
                            <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('soporte') }}"><i
                                        class="text-success ti-book"></i>Crear nuevo
                                    ticket</a>
                            </div>
                        </div>
                        <div class="scrollbar max-h-550 tickets-info">
                            <ul class="list-unstyled">
                                @foreach ($t as $t)
                                    <li class="mb-15">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="mt-0 ">{{ $t->asunto }} - <small
                                                        @if ($t->status == 'abierto') class="text-success" @elseif($t->status == 'cerrado') class="text-danger" @endif> {{ $t->status }}</small></h6>

                                                <p class="mt-10">{{ $t->mensaje }}</p>
                                            </div>
                                        </div>
                                        <div class="divider mt-15"></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>





            </div>
        </div>
    </div>
@endsection


@push('js')

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        ! function(a) {
            a.fn.datepicker.dates.es = {
                days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                    "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                today: "Hoy",
                monthsTitle: "Meses",
                clear: "Borrar",
                weekStart: 1,
                format: "dd/mm/yyyy"
            }
        }(jQuery);
    </script>


    <script>
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
                NSS: "Recuerda ingresar los 11 dígitos de tu seguro del IMSS.",
                phone: "Este campo no debe estar vacio."
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
                NSS: {
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


@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />


    <style>
        #formulario .error {
            color: red;
        }

    </style>

@endpush
