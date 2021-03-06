@extends('admin')

@section('section')
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Inicio</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html" class="default-color">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        @role('Administrator')



        @endrole
        @role('User')

        <div class="row">
            <div class="col-xl-4 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body text-left ">
                        <h5 class="card-title" style="text-transform: inherit !important;">Sigue estos pasos para
                            disfrutar de todos los beneficios de Programa Seguro. </h5>
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <b>@if ($s[0]->datos == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i>   @else @endif 1. Completa tus datos personales</b>
                                {{-- <h4 class="text-success mt-10">1582</h4> --}}
                            </div>

                            <div class="col-12 col-sm-12 mt-20">
                                <b> @if ($s[0]->pago == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i> @else @endif 2. Realiza el pago de tu primera mensualidad</b>
                                {{-- <h4 class="text-success mt-10">1582</h4> --}}
                            </div>

                            <div class="col-12 col-sm-12 mt-20">
                                <b>@if ($s[0]->pago == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i> @else @endif 3. Te damos de alta en el IMSS</b>
                                {{-- <h4 class="text-success mt-10">1582</h4> --}}
                            </div>

                            <div class="col-12 col-sm-12 mt-20">
                                <b> @if ($s[0]->pago == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i> @else @endif 4. ??Goza de los beneficios de Programa Seguro!
                                </b>
                                {{-- <h4 class="text-success mt-10">1582</h4> --}}
                            </div>

                        </div>
                        <div class="divider mt-20"></div>
                        @if ($s[0]->datos == '0')
                            <a class="button btn-block" href="{{ route('completarDatos') }}"> Completar
                                mis
                                datos </a>
                        @elseif ($s[0]->pago == '0')
                            <a class="button btn-block" href="{{ route('pagos') }}"> Realizar pago </a>
                        @elseif ($s[0]->pago == '1')
                            <p class="mt-10"><b>NOTA</b>: Los pasos 3 y 4 quedar??n realizados el d??a h??bil siguiente del d??a de tu pago. </p>
                        @endif

                    </div>
                </div>


            </div>


        </div>
        @endrole
        <!-- Orders Status widgets-->

    </div><!-- main content wrapper end-->
@endsection


@push('js')
    <script>
        @if (Session::has('successPago'))
            Swal.fire({
            title: 'Pago realizado con ??xito',
            html: 'Tu pago se ha realizado de forma correcta, ahora podr??s disfrutar de los servicios de <b>Programa
                Seguro</b>.',
            icon: 'success',
            confirmButtonText: 'Cerrar'

            })
        @endif


        @if (Session::has('successDatos'))
            Swal.fire({
            title: '??Datos guardados con ??xito!',
            html: '??La informaci??n de tus datos personales se ha guardado con ??xito!<br> El siguiente paso es realizar tu pago
            para poder gozar de los beneficios de <b>Programa Seguro</b>.',
            icon: 'success',
            confirmButtonText: 'Cerrar'

            })
        @endif
    </script>
@endpush
