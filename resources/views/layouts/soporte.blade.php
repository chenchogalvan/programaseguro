@extends('admin')

@section('section')






    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Ayuda</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="default-color">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Ayuda</li>
                    </ol>
                </div>
            </div>
        </div>


        <style>
            select.form-control:not([size]):not([multiple]) {
                height: calc(2.8rem + 10px) !important;
            }

        </style>


        @role('User')


            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <h5 class="card-title">Formulario de ayuda</h5>
                            <form method="POST" action="{{ route('guardar.tiket') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="asunto">Selecciona el asunto</label>
                                    <select class="form-control" id="asunto" name="asunto" required>
                                        <option value="Problema al realizar el pago">Problema al realizar el pago</option>
                                        <option value="Problema al Completar mis datos">Problema al Completar mis datos</option>
                                        <option value="No puedo actualizar mi información">No puedo actualizar mi información
                                        </option>
                                        <option value="Actualizar información">Actualizar información
                                        </option>
                                        <option value="Quiero darme de baja">Quiero darme de baja</option>
                                        <option value="Otra">Otra</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="mensaje">Escribe el mensaje lo más detallado posible</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="8" required></textarea>
                                </div>


                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 mb-30">
                    <div class="card card-statistics mb-30">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered p-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Asunto</th>
                                            <th>Mensaje</th>
                                            <th>Estatus</th>
                                            <th>Fecha de creación</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($tu as $t)

                                            <tr>
                                                <td>{{ $t->id }}</td>
                                                <td>{{ $t->asunto }}</td>
                                                <td>{{ $t->mensaje }}</td>
                                                <td>{{ $t->status }}</td>
                                                <td>{{ $t->created_at->format('d/m/Y') }}</td>
                                            </tr>

                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        @endrole


        @role('Administrator')

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered p-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Asunto</th>
                                            <th>Mensaje</th>
                                            <th>Estatus</th>
                                            <th>Fecha de creación</th>
                                            <th>Nota de cierre</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($t as $t)

                                            <tr>
                                                <td>{{ $t->id }}</td>
                                                <td>{{ $t->user->name }} {{ $t->user->middleName }}
                                                    {{ $t->user->lastName }}
                                                </td>
                                                <td>{{ $t->user->phone }}</td>
                                                <td>{{ $t->user->email }}</td>

                                                <td>{{ $t->asunto }}</td>
                                                <td>{{ $t->mensaje }}</td>


                                                <td>
                                                    @if ($t->status == 'abierto')
                                                        <span class="badge badge-pill badge-success">{{ $t->status }}</span>

                                                    @elseif ($t->status == 'cerrado')
                                                        <span class="badge badge-pill badge-danger">{{ $t->status }}</span>

                                                    @endif
                                                </td>
                                                <td>{{ $t->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    @if ($t->status == 'abierto')


                                                    @elseif ($t->status == 'cerrado')
                                                        {{ $t->notaMensaje }}

                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($t->status == 'abierto')
                                                        {{-- <a href="{{ route('cerrarTicket', $t->id) }}"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-warning"></i>
                                                        Cerrar ticket</a> --}}

                                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#exampleModalCenter-{{ $t->id }}"> <i
                                                                class="fa fa-warning"></i>
                                                            Cerrar ticket </a>


                                                        <div class="modal fade" id="exampleModalCenter-{{ $t->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="modal-title">
                                                                            <div class="mb-30">
                                                                                <h6></h6>
                                                                                <h2>Cerrar ticket con el ID {{ $t->id }}
                                                                                </h2>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button> --}}
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('cerrarTicket', $t->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <textarea id="text-3" name="mensaje" rows="5"
                                                                                class="form-control mb-20"
                                                                                placeholder="Escribe una nota"
                                                                                required></textarea>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Cerrar ticket</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>





                                                    @else

                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach








                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

        @role('Agent')

            <div class="row">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered p-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Asunto</th>
                                            <th>Mensaje</th>
                                            <th>Estatus</th>
                                            <th>Fecha de creación</th>
                                            <th>Nota de cierre</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($t as $t)

                                            <tr>
                                                <td>{{ $t->id }}</td>
                                                <td>{{ $t->user->name }} {{ $t->user->middleName }}
                                                    {{ $t->user->lastName }}
                                                </td>
                                                <td>{{ $t->user->phone }}</td>
                                                <td>{{ $t->user->email }}</td>

                                                <td>{{ $t->asunto }}</td>
                                                <td>{{ $t->mensaje }}</td>


                                                <td>
                                                    @if ($t->status == 'abierto')
                                                        <span class="badge badge-pill badge-success">{{ $t->status }}</span>

                                                    @elseif ($t->status == 'cerrado')
                                                        <span class="badge badge-pill badge-danger">{{ $t->status }}</span>

                                                    @endif
                                                </td>
                                                <td>{{ $t->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    @if ($t->status == 'abierto')


                                                    @elseif ($t->status == 'cerrado')
                                                        {{ $t->notaMensaje }}

                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($t->status == 'abierto')
                                                        {{-- <a href="{{ route('cerrarTicket', $t->id) }}"
                                                            class="btn btn-danger btn-sm"><i class="fa fa-warning"></i>
                                                            Cerrar ticket</a> --}}

                                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#exampleModalCenter-{{ $t->id }}"> <i
                                                                class="fa fa-warning"></i>
                                                            Cerrar ticket </a>


                                                        <div class="modal fade" id="exampleModalCenter-{{ $t->id }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="modal-title">
                                                                            <div class="mb-30">
                                                                                <h6></h6>
                                                                                <h2>Cerrar ticket con el ID {{ $t->id }}
                                                                                </h2>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button> --}}
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('cerrarTicket', $t->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <textarea id="text-3" name="mensaje" rows="5"
                                                                                class="form-control mb-20"
                                                                                placeholder="Escribe una nota"
                                                                                required></textarea>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Cerrar ticket</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancelar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else

                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

    </div>
@endsection



@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush


@push('js')
    <script>
        @if (Session::has('successMessage'))
            Swal.fire({
            title: 'Ticket registrado',
            text: 'Ticket de ayuda registrado exitosamente. Nos pondremos en contacto contigo lo antes posible.',
            icon: 'success',
            confirmButtonText: 'Cerrar'
            })

        @endif

        @if (Session::has('succes'))
            Swal.fire({
            title: 'Ticket Cerrado',
            text: 'El ticket se cerro correctamente',
            icon: 'success',
            confirmButtonText: 'Cerrar'
            })
        @endif
    </script>

    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "lengthMenu": "Mostrando _MENU_ registros por página",
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
