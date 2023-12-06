<?php

namespace App\Helpers\Service;

use App\Models\CustomerCart;
use App\Models\HistoryTransaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{

    public function transaction($response, $validated_data, $items)
    {

        DB::transaction(function () use ($response, $validated_data, $items) {


            $history = HistoryTransaction::create([
                'checkout_id' => $response->checkoutId,
                'checkout_link' => $response->redirectUrl,
                'total_price' => $validated_data['total'],
                'payment_method'=>$validated_data['payment_method']
            ]);

            foreach ($validated_data['products'] as $prod) {
                $history->historyTransactionData()->create([
                    'product_id' => $prod['id'],
                    'price' => $prod['price'],
                    'qty' => $prod['qty'],
                ]);
            }

            CustomerCart::whereIn('id', $items['ids'])->delete();
        });
    }
}
