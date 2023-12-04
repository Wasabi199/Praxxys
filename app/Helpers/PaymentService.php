<?php

namespace App\Helpers;

use App\Models\CustomerCart;
use App\Models\HistoryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;

class PaymentService
{


    public static function CheckOut($product)
    {

        try {
            $qty = 0;
            $items = [];
            $cartIds = [];
            foreach ($product['products'] as $prod) {
                $qty += $prod['qty'];
                $cartIds[] = $prod['id'];
                $items[] =      [
                    'name' => $prod['name'],
                    'quantity' => $prod['qty'],
                    'description' => 'Description of the test product',
                    'amount' => [
                        'value' => $prod['price'],
                        'details' => [
                            'subtotal' => $prod['price'] * $prod['qty'],
                            'discount' => 0,
                            'serviceCharge' => 0,
                            'shippingFee' => 0,
                            'tax' => 0
                        ]
                    ],
                    'totalAmount' => [
                        'currency' => 'PHP',
                        'value' => $prod['price'] * $prod['qty'],
                        'details' => [
                            'subtotal' => $prod['price'] * $prod['qty']
                        ]
                    ]
                ];
            }


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
                'items' => $items,
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

            DB::transaction(function () use ($response, $product, $cartIds) {
                HistoryTransaction::create([
                    'checkout_id' => $response->checkoutId,
                    'checkout_link' => $response->redirectUrl,
                    'total_price' => $product['total'],
                ]);

                CustomerCart::whereIn('id',$cartIds)->delete();
            });

            return $response->redirectUrl;
        } catch (\throwable $th) {
            Log::channel('payment')->error($th);
        }
    }
}
