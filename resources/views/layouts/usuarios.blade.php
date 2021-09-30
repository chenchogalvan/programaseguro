@extends('admin')

@section('section')
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Lista de usuarios registrados</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="default-color">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Lista de usuarios registrados</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>CURP</th>
                                    <th>NSS</th>
                                    <th>RFC</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($u as $u)

                                    <tr>
                                        <td>{{ $u->name . ' ' . $u->middleName . ' ' . $u->lastName }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->birthday }}</td>
                                        <td>{{ $u->CURP }}</td>
                                        <td>{{ $u->NSS }}</td>
                                        <td>{{ $u->RFC }}</td>
                                        <td>
                                            @if ($u->CURP == null || $u->NSS == null || $u->RFC == null || $u->birthday == null)
                                                <span class="badge badge-danger"> Datos incompletos </span>


                                            @else

                                                <span class="badge badge-success"> Datos completos </span>


                                            @endif
                                        </td>
                                        <td><a href="{{ route('editarUsuario', $u->id) }}"
                                                class="btn btn-warning btn-sm"><i class="fa fa-book"></i>
                                                Editar usuario</a></td>
                                    </tr>

                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>CURP</th>
                                    <th>NSS</th>
                                    <th>RFC</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script>
        @if (Session::has('successEdit'))
            swal(
            'Registro modificado con éxito',
            'Los datos del usuario fueron modificados con éxito',
            'success'
            )
        @endif
    </script>

    @push('js')
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    "language": {
                        "lengthMenu": "Mostrando _MENU_ registros por pagina",
                        "zeroRecords": "No hay registros",
                        "info": "Pagina _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": "Buscar",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    }
                });
            });
        </script>
    @endpush

@endpush
