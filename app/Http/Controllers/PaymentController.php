<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago;

class PaymentController extends Controller
{
    public function ProcessPayment(Request $request)
    {
        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float)$request->get('transactionAmount');
        $payment->token = $request->get('token');
        $payment->description = $request->get('description');
        $payment->installments = (int)$request->get('installments');
        $payment->payment_method_id = $request->get('paymentMethodId');
        $payment->issuer_id = (int)$request->get('issuer');

        $payer = new MercadoPago\Payer();
        $payer->email = $request->get('email');
        $payer->identification = array(
            "number" => $request->get('docNumber')
        );
        $payment->payer = $payer;

        $payment->save();

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        echo json_encode($response);
    }
}
