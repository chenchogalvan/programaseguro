@extends('admin')


@section('section')
    <div class="content-wrapper profile-page">



        <div class="row">
            <div class="col-xl-4 mb-30">
                <div class="card mb-30 about-me">
                    <div class="card-body">
                        <h5 class="card-title"> Información del usuario</h5>






                        <ul class="list-unstyled ">
                            <li class="list-item"><span class="text-info ti-star"></span><b>Nombre:</b>
                                {{ $user->name.' '.$user->middleName.' '.$user->lastName }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>Teléfono:</b>
                                {{ $user->phone }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>Correo:</b>
                                {{ $user->email }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>RFC:</b>
                                {{ $user->RFC }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>N° Seguro:</b>
                                {{ $user->NSS }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>CURP:</b>
                                {{ $user->CURP }}
                            </li>


                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xl-8 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title border-0 pb-0">Lista de pagos y estatus</h5>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered p-0">
                                <thead>
                                    <tr>
                                        <th>Fecha de pago</th>
                                        <th>Fecha de vencimiento</th>
                                        <th>Estatus del pago</th>
                                        <th>Tipo de pago</th>
                                        <th>Id del pago (MP)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- @foreach ($u as $u)

                                        <tr>
                                            <td>{{ $u->name . ' ' . $u->middleName . ' ' . $u->lastName.' || '.$u->id }}</td>
                                            @foreach ($u->pago as $p)
                                                <td>{{ date('d-m-Y', strtotime($p->fechaVencimiento)) }}</td>
                                                <td>{{ $p->status }}</td>
                                                <td>{{ $p->payment_type }}</td>
                                                <td>{{ $p->payment_id }}</td>
                                            @endforeach
                                        </tr>

                                    @endforeach --}}

                                    @foreach ($pagos as $p)
                                        <tr>

                                            <td>{{ $p->created_at }}</td>
                                            <td>{{ $p->fechaVencimiento }}</td>
                                            <td>@if ($p->status == 'approved')<span class="badge bg-success float-end mt-1 text-white">Aprobado</span>@elseif ($p->status == 'pending')<span class="badge bg-warning float-end mt-1 text-white">   Pendiente </span>@elseif ($p->status == 'failure')<span class="badge bg-danger float-end mt-1 text-white">   Fallido/Cancelado </span>@endif</td>
                                            <td>{{ $p->payment_type }}</td>
                                            <td>{{ $p->payment_id }}</td>

                                        </tr>


                                    @endforeach


                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


@push('js')
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

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush
