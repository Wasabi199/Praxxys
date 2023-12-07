<?php

namespace App\Helpers\Service;

class ItemService{

    public function item($validated_data){

        $qty = 0;
        $items = [];
        $cartIds = [];

        foreach ($validated_data['products'] as $prod) {
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

        return [
            'qty'=>$qty,
            'items'=>$items,
            'ids'=>$cartIds
        ];
    }
}