@extends('admin')

@section('section')
    @php
    // SDK de Mercado Pago
    require base_path('/vendor/autoload.php');
    // Agrega credenciales
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Mi producto';
    $item->quantity = 1;
    $item->unit_price = 100;
    $preference->items = [$item];

    $preference->payment_methods = [
        'excluded_payment_methods' => [['id' => 'paypal']],
        'installments' => 1,
    ];

    $preference->back_urls = [
        'success' => config('app.url') . 'sistema/pagos/status',
        'failure' => config('app.url') . 'sistema/pagos/status',
        'pending' => config('app.url') . 'sistema/pagos/status',
    ];
    $preference->auto_return = 'approved';

    $preference->save();

    @endphp



    <div class="content-wrapper">

        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Suscripción</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html" class="default-color">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Suscripción</li>
                    </ol>
                </div>
            </div>
        </div>





        <!-- widgets -->
        <div class="row">
            <div class="col-xl-4 mb-60">
                <div class="pricing-table active">
                    <div class="pricing-top">
                        <div class="pricing-title">
                            <h3 class="mb-15">Pago mensual </h3>
                            <p>Realiza tu pago para contar con todos los beneficios de Programa Seguro</p>
                        </div>
                        <div class="pricing-prize">
                            <h2>$129 /<span> Mensuales</span> </h2>
                        </div>
                        <div class="pricing-button">
                            <a class="button" href="{{ $preference->init_point }}">Realizar pago</a>
                            {{-- <a href="#" class="button cho-container"></a> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-xl-4">
        <!-- Step #2 -->
        <form id="form-checkout">
            @csrf
            <input type="text" name="cardNumber" id="form-checkout__cardNumber" />
            <input type="text" name="cardExpirationMonth" id="form-checkout__cardExpirationMonth" />
            <input type="text" name="cardExpirationYear" id="form-checkout__cardExpirationYear" />
            <input type="text" name="cardholderName" id="form-checkout__cardholderName" />
            <input type="email" name="cardholderEmail" id="form-checkout__cardholderEmail" />
            <input type="text" name="securityCode" id="form-checkout__securityCode" />
            <select name="issuer" id="form-checkout__issuer"></select>
            <select name="identificationType" id="form-checkout__identificationType"></select>
            <input type="text" name="identificationNumber"
                id="form-checkout__identificationNumber" />
            <select name="installments" id="form-checkout__installments"></select>
            <button type="submit" id="form-checkout__submit">Pagar</button>
            <progress value="0" class="progress-bar">Cargando...</progress>
        </form>
    </div> --}}
        </div>


    </div><!-- main content wrapper end-->
@endsection

@push('js')
    {{-- SDK MercadoPago.js V2 --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>





    <script>
        //Alertas
        @if (Session::has('pending'))
            swal(
            'Pago pendiente',
            'Tu pago se está procesando, esto puede tardar de 1 a 3 días habiles. Te notificaremos una ves se haya procesado.',
            'info',
            'Cerrar'
            )
        @endif

        @if (Session::has('failure'))
            swal(
            'Pago Fallido',
            'El pago ha fallado, intenta de nuevo o comunicate con nosotros para apoyarte.',
            'warning',
            'ok'
            )
        @endif

        // Agrega credenciales de SDK
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
            locale: 'es-MX'
        });

        // // Inicializa el checkout
        // mp.checkout({
        //     preference: {
        //         id: "{{ $preference->id }}"
        //     },
        //     //autoOpen: true,
        //     render: {
        //         container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
        //         label: 'Pagar', // Cambia el texto del botón de pago (opcional)

        //     }
        // });

        // const cardForm = mp.cardForm({
        //     amount: "100.5",
        //     autoMount: true,
        //     form: {
        //         id: "form-checkout",
        //         cardholderName: {
        //         id: "form-checkout__cardholderName",
        //         placeholder: "Titular de la tarjeta",
        //         },
        //         cardholderEmail: {
        //         id: "form-checkout__cardholderEmail",
        //         placeholder: "E-mail",
        //         },
        //         cardNumber: {
        //         id: "form-checkout__cardNumber",
        //         placeholder: "Número de la tarjeta",
        //         },
        //         cardExpirationMonth: {
        //         id: "form-checkout__cardExpirationMonth",
        //         placeholder: "Mes de vencimiento",
        //         },
        //         cardExpirationYear: {
        //         id: "form-checkout__cardExpirationYear",
        //         placeholder: "Año de vencimiento",
        //         },
        //         securityCode: {
        //         id: "form-checkout__securityCode",
        //         placeholder: "Código de seguridad",
        //         },
        //         installments: {
        //         id: "form-checkout__installments",
        //         placeholder: "Cuotas",
        //         },
        //         identificationType: {
        //         id: "form-checkout__identificationType",
        //         placeholder: "Tipo de documento",
        //         },
        //         identificationNumber: {
        //         id: "form-checkout__identificationNumber",
        //         placeholder: "Número de documento",
        //         },
        //         issuer: {
        //         id: "form-checkout__issuer",
        //         placeholder: "Banco emisor",
        //         },
        //     },
        //     callbacks: {
        //         onFormMounted: error => {
        //         if (error) return console.warn("Form Mounted handling error: ", error);
        //         console.log("Form mounted");
        //         },
        //         onSubmit: event => {
        //         event.preventDefault();

        //         const {
        //             paymentMethodId: payment_method_id,
        //             issuerId: issuer_id,
        //             cardholderEmail: email,
        //             amount,
        //             token,
        //             installments,
        //             identificationNumber,
        //             identificationType,
        //         } = cardForm.getCardFormData();

        //         fetch("/process_payment", {
        //             method: "POST",
        //             headers: {
        //             "Content-Type": "application/json",
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             body: JSON.stringify({
        //             token,
        //             issuer_id,
        //             payment_method_id,
        //             transaction_amount: Number(amount),
        //             installments: Number(installments),
        //             description: "Descripción del producto",
        //             payer: {
        //                 email,
        //                 identification: {
        //                 type: identificationType,
        //                 number: identificationNumber,
        //                 },
        //             },
        //             }),
        //         });
        //         },
        //         onFetching: (resource) => {
        //         console.log("Fetching resource: ", resource);

        //         // Animate progress bar
        //         const progressBar = document.querySelector(".progress-bar");
        //         progressBar.removeAttribute("value");

        //         return () => {
        //             progressBar.setAttribute("value", "0");
        //         };
        //         },
        //     },
        // });
    </script>
@endpush
