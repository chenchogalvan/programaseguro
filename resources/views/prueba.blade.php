
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


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
        $item->unit_price = 75.56;
        $preference->items = array($item);
        $preference->save();

    @endphp



    <div class="cho-container">

    </div>




    {{-- <script src="/js/app.js"></script> --}}
    {{-- SDK MercadoPago.js V2 --}}
    <script src="https://sdk.mercadopago.com/js/v2"></script>


    <script>
        // Agrega credenciales de SDK
          const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
                locale: 'es-MX'
          });

          // Inicializa el checkout
          mp.checkout({
              preference: {
                  id: "{{ $preference->id }}"
              },
              autoOpen: true,
            //   render: {
            //         container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
            //         label: 'Pagar', // Cambia el texto del botón de pago (opcional)
            //   }
        });
        </script>
</body>
</html>
