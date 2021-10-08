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

        <div class="row">
            <div class="col-xl-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title border-0 pb-0">Guia de metodos de pago</h5>
                        <div class="table-responsive">
                            <table class="mb-0 table">
                                <thead>
                                    <tr>
                                        <th>Medio de pago </th>
                                        <th>Tipo de pago</th>
                                        <th>Medio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Visa</td>
                                        <td>credit_card</td>
                                        <td>visa</td>
                                    </tr>
                                    <tr>
                                        <td>Mastercard</td>
                                        <td>credit_card</td>
                                        <td>master</td>
                                    </tr>
                                    <tr>
                                        <td>American</td>
                                        <td>credit_card</td>
                                        <td>amex</td>
                                    </tr>
                                    <tr>
                                        <td>Visa Débito</td>
                                        <td>debit_card</td>
                                        <td>debvisa</td>
                                    </tr>
                                    <tr>
                                        <td>Mastercard Débito</td>
                                        <td>debit_card</td>
                                        <td>debmaster</td>
                                    </tr>
                                    <tr>
                                        <td>Tarjeta Mercado Pago</td>
                                        <td>prepaid_card</td>
                                        <td>mercadopagocard</td>
                                    </tr>
                                    <tr>
                                        <td>Oxxo</td>
                                        <td>ticket</td>
                                        <td>oxxo</td>
                                    </tr>
                                    <tr>
                                        <td>BBVA Bancomer</td>
                                        <td>atm</td>
                                        <td>bancomer</td>
                                    </tr>
                                    <tr>
                                        <td>Banamex</td>
                                        <td>atm</td>
                                        <td>banamex</td>
                                    </tr>
                                    <tr>
                                        <td>Santander</td>
                                        <td>atm</td>
                                        <td>serfin</td>
                                    </tr>
                                    <tr>
                                        <td>Dinero en cuenta</td>
                                        <td>account_money</td>
                                        <td>account_money</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title border-0 pb-0">Lista de pagos y estatus</h5>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered p-0">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha de vencimiento</th>
                                        <th>Estatus del pago</th>
                                        <th>Tipo de pago</th>
                                        <th>Id del pago (MP)</th>
                                        <th>Acciones</th>
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

                                    @foreach ($p as $p)
                                        <tr>
                                            <td>{{ $p->user['name'] . ' ' . $p->user['middleName'] . ' ' . $p->user['lastName'] }}
                                            </td>
                                            <td>{{ $p->fechaVencimiento }}</td>
                                            <td>@if ($p->status == 'approved')<span class="badge bg-success float-end mt-1 text-white">Aprovado</span>@elseif ($p->status == 'pending')<span class="badge bg-warning float-end mt-1 text-white">   Pendiente </span>@elseif ($p->status == 'failure')<span class="badge bg-danger float-end mt-1 text-white">   Fallido/Cancelado </span>@endif</td>
                                            <td>{{ $p->payment_type }}</td>
                                            <td>{{ $p->payment_id }}</td>
                                            <td>

                                                @if ($p->status == 'pending')
                                                    <a href="{{ route('modificarPago', ['aprobar', $p]) }}"
                                                        class="btn btn-success">Aprobar pago</a>

                                                    <a href="{{ route('modificarPago', ['cancelar', $p]) }}"
                                                        class="btn btn-danger">Cancelar pago</a>

                                                @elseif ($p->status == 'failure')
                                                    <a href="{{ route('modificarPago', ['aprobar', $p]) }}"
                                                        class="btn btn-success">Aprobar pago</a>


                                                @elseif ($p->status == 'approved')
                                                    <a href="{{ route('modificarPago', ['cancelar', $p]) }}"
                                                        class="btn btn-danger">Cancelar pago</a>

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
    </div>
@endsection


@push('js')
    <script>
        @if (Session::has('modify'))
            Swal.fire({
            title: 'Modificación realizada',
            html: '{!! Session::get('modify') !!}',
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

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush
