<?php

namespace App\Helpers\Method;

use App\Helpers\Interface\PaymentInterface as PaymentInterface;
use App\Helpers\Service\ItemService;
use App\Helpers\Service\TransactionService;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Ixudra\Curl\Facades\Curl;

class PayMaya implements PaymentInterface{


    protected $itemService;
    protected $transactionService;

    public function __construct(ItemService $itemService, TransactionService $transactionService)
    {
        $this->itemService = $itemService;
        $this->transactionService = $transactionService;
        
    }
    public function checkOut($validated_data)
    {
        try{
            $items = $this->itemService->item($validated_data);

            $data = [
                'totalAmount' => [
                    'currency' => 'PHP',
                    'value' => $validated_data['total'],
                    'details' => [
                        'discount' => 0,
                        'serviceCharge' => 0,
                        'shippingFee' => 0,
                        'tax' => 0,
                        'subtotal' => $validated_data['total']
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
            ->withAuthorization('authorization: Basic ' . env("PAYMAYA_AUTH"))
            ->withData($data)
            ->asJson()
            ->post();

            $this->transactionService->transaction($response, $validated_data, $items);


            return $response->redirectUrl;
            
            

        }catch(\Throwable $th){
            Log::channel('payment')->error($th);
        }
    }

}