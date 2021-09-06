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

        <div class="row">

            <div class="col-xl-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title">Da de alta un usuario en el sistema</h5>
                        <form id="formulario" method="post" action="{{ route('saveuser') }}" class="form-horizontal">
                            @csrf

                            <div class="form-group">
                                <label class="control-label" for="name">nombre</label>
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
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="84411122233" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="birthday">Fecha de nacimiento</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="birthday" name="09/04/91"
                                        placeholder="Fecha de nacimiento" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="name">CURP</label>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="CURP" name="CURP" placeholder=""
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
                                    <input type="text" class="form-control" id="RFC" name="RFC" placeholder="" required />
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


@push('js')

    <script>
        @if (Session::has('success'))
            swal(
            'Registro guardado con éxito',
            'El usuario fue registradó con éxito, se le envió un correo con la información para accesar.',
            'suuccess',
            'Cerrar'
            )
        @endif


        $("#formulario").validate({
            messages: {
                name: "Este campo es necesario",
                middleName: "Este campo es necesario",
                lastName: "Este campo es necesario",
                email: "Este campo es necesario",
                phone: "Este campo es necesario",
                birthday: "Este campo es necesario",
                CURP: "Este campo es necesario",
                NSS: "Este campo es necesario",
                RFC: "Este campo es necesario",
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
    </script>

@endpush
