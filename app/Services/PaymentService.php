<?php

namespace App\Services;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentAmountEntity;
use App\Entities\Payment\PaymentAuthEntity;
use App\Entities\Payment\PaymentEntity;
use App\Entities\Payment\PaymentPayerEntity;
use App\Entities\Payment\PaymentRequestEntity;
use App\Entities\Payment\PaymentResponseEntity;
use App\Services\Contracts\IPaymentService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentService implements IPaymentService
{
    public function createRequest(PaymentRequestEntity $paymentRequestEntity): PaymentResponseEntity|null
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://dev.placetopay.com/redirection/api/session', [
            "locale" => $paymentRequestEntity->locale,
            "auth" => [
                "login" => $paymentRequestEntity->auth->login,
                "tranKey" => $paymentRequestEntity->auth->tranKey,
                "nonce" => $paymentRequestEntity->auth->nonce,
                "seed" => $paymentRequestEntity->auth->seed
            ],
            "payment" => [
                "reference" => $paymentRequestEntity->payment->reference,
                "description" => $paymentRequestEntity->payment->description,
                "amount" => [
                    "currency" => $paymentRequestEntity->payment->amount->currency,
                    "total" => $paymentRequestEntity->payment->amount->total
                ],
                "allowPartial" => false
            ],
            "expiration" => $paymentRequestEntity->expiration,
            "returnUrl" => $paymentRequestEntity->returnUrl,
            "ipAddress" => $paymentRequestEntity->ipAddress,
            "userAgent" => $paymentRequestEntity->userAgent
        ]);

        if (!$response->successful()) {
            $errorData = $response->json();

            throw new \Exception(
                'Error en el pago. ' .
                $errorData['status']['message'] ?? 'No se pudo generar el pago, por favor intente nuevamente.'
            );
        }

        $responseData = $response->json();

        if ($responseData) {
            if (isset($responseData['requestId']) && isset($responseData['processUrl'])) {
                return new PaymentResponseEntity($responseData['requestId'], $responseData['processUrl']);
            }
        }

        return null;
    }


    public function buildPaymentRequest(
        int $orderId, OrderRequestEntity $orderRequestEntity): PaymentRequestEntity|null
    {
        $paymentRequest = new PaymentRequestEntity();
        $paymentRequest->locale = 'es_CO';

        $nonce = (string)Str::uuid();
        $seed = Carbon::now()->toW3cString();
        $paymentRequest->auth = new PaymentAuthEntity(
            env('PLACETOPLAY_LOGIN'),
            base64_encode(
                sha1($nonce . $seed . env('PLACETOPLAY_SECRETKEY'), true)
            ),
            base64_encode($nonce),
            $seed
        );

        $paymentRequest->payer = new PaymentPayerEntity(
            $orderRequestEntity->customerName,
            $orderRequestEntity->customerEmail,
            $orderRequestEntity->customerMobile,
        );

        $paymentRequest->payment = new PaymentEntity(
            (string)$orderId,
            $orderRequestEntity->description,
            new PaymentAmountEntity($orderRequestEntity->total, $orderRequestEntity->currency)
        );

        $paymentRequest->expiration = Carbon::now()->addMinutes(20)->toW3cString();
        $paymentRequest->returnUrl = 'http://localhost/api/v1';
        $paymentRequest->ipAddress = '127.0.0.1';
        $paymentRequest->userAgent = $_SERVER['HTTP_USER_AGENT'];

        return $paymentRequest;
    }
}
