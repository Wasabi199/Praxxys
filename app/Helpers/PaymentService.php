<?php

namespace App\Helpers;

use App\Models\CustomerCart;
use App\Models\HistoryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;

class PaymentService
{


    public static function checkOut($product)
    {

        try {
           
            $items = ItemService::item($product);

            $data = [
                'totalAmount' => [
                    'currency' => 'PHP',
                    'value' => $product['total'],
                    'details' => [
                        'discount' => 0,
                        'serviceCharge' => 0,
                        'shippingFee' => 0,
                        'tax' => 0,
                        'subtotal' => $product['total']
                    ]
                ],
                'items' => $items['items'],
                'redirectUrl' => [
                    'success' => env("APP_URL") . '/success',
                    'failure' => env("APP_URL") . '/failure',
                    'cancel' => env("APP_URL") . '/canceled'
                ],
                'requestReferenceNumber' => 'ABC123',
                'metadata' => [
                    'customerId' => '123456',
                    'notes' => 'Additional notes or metadata'
                ]
            ];

            

            $response = Curl::to('https://pg-sandbox.paymaya.com/checkout/v1/checkouts')
                ->withHeader('Content-Type: application/json')
                ->withHeader('accept: application/json')
                // ->withHeader('Access-Control-Allow-Origin: http://127.0.0.1:8000')
                ->withAuthorization('authorization: Basic ' . env("PAYMAYA_AUTH"))
                ->withData($data)
                ->asJson()
                ->post();


                TransactionService::transaction($response, $product, $items);

    

            return $response->redirectUrl;
        } catch (\throwable $th) {
            Log::channel('payment')->error($th);
        }
    }
}
