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
    @if (Session::has('successDatos'))
        <div class="row">
            <div class="col-xl-4 mb-30">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">¡Datos guardados con éxito!</h4>
                    <p>¡La información de tus datos personales se ha guardado con éxito!</p>
                    <hr>
                    <p class="mb-0">El siguiente paso es realizar tu pago para poder gozar de los
                        beneficios de programa seguro.</p>
                </div>

            </div>
        </div>


    @endif
    <div class="row">
        <div class="col-xl-4 mb-30">
            <div class="card card-statistics h-100">
                <div class="p-4 text-center bg" style="background: url(/images/bg/01.jpg);">
                    <h5 class="mb-70 text-white text-left position-relative">Sigue estos pasos para
                        disfrutar de todos los beneficios de Programa Seguro. </h5>

                </div>
                <div class="card-body text-left position-relative">
                    <div class="avatar-top">
                        <img style="visibility: hidden;" class="img-fluid w-25 rounded-circle " src="/images/team/13.jpg" alt="">
                    </div>
                    <div class="row" style="margin-top: -15px;">
                        <div class="col-12 col-sm-12 mt-20">
                            <b>@if ($s[0]->datos == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i>   @else @endif 1. Completa tus datos personales</b>
                            {{-- <h4 class="text-success mt-10">1582</h4> --}}
                        </div>

                        <div class="col-12 col-sm-12 mt-20">
                            <b> @if ($s[0]->pago == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i> @else @endif 2. Realiza el pago de tu primera mensualidad</b>
                            {{-- <h4 class="text-success mt-10">1582</h4> --}}
                        </div>

                        <div class="col-12 col-sm-12 mt-20">
                            <b>@if ($s[0]->alta == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i> @else @endif 3. Te damos de alta en el IMSS</b>
                            {{-- <h4 class="text-success mt-10">1582</h4> --}}
                        </div>

                        <div class="col-12 col-sm-12 mt-20">
                            <b> @if ($s[0]->alta == '1') <i style="font-size: 20px;" class="fa fa-check-circle text-success" ></i> @else @endif 4. ¡Goza de los beneficios de Programa Seguro!
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
        swal(
        'Pago realizado con éxito',
        'Tu pago se ha realizado de forma correcta, ahora podrás disfrutar de los servicios de Programa Seguro.',
        'success',
        'Cerrar'
        )
    @endif
</script>
@endpush
