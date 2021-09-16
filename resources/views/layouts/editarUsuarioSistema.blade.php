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

        <div class="row">

            <div class="col-xl-4 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title" style="text-transform: ">Editar datos de {{ $user->name.' '. $user->middleName.' '.$user->middleName }}</h5>
                        <form id="formulario" method="post" action="{{ route('actualizarInfoUsuarioSistema', $user) }}" class="form-horizontal">
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


                            {{-- <div class="form-group">
                                <label class="control-label" for="password">contraseña</label>
                                <div class="mb-2">
                                    <input type="password" class="form-control" id="password" name="password" required />
                                </div>
                            </div> --}}

                            {{-- <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="rol" value="Agent" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio1">Agente</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="rol" value="Administrator" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Administrador</label>
                                </div>
                            </div> --}}





                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Editar información</button>
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
            'success',
            'Cerrar'
            )
        @endif

        @if (Session::has('successDel'))
            swal(
            'Registro eliminado con éxito',
            'El usuario fue eliminado con éxito',
            'success',
            'Cerrar'
            )
        @endif



    </script>

@endpush
