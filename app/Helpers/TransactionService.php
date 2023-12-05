<?php

namespace App\Helpers;

use App\Models\CustomerCart;
use App\Models\HistoryTransaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{

    public static function transaction($response, $product, $items)
    {

        DB::transaction(function () use ($response, $product, $items) {
            $history = HistoryTransaction::create([
                'checkout_id' => $response->checkoutId,
                'checkout_link' => $response->redirectUrl,
                'total_price' => $product['total'],
            ]);

        foreach ($product['products'] as $prod) {
            $history->historyTransactionData()->create([
                'product_id'=>$prod['id'],
                'price'=>$prod['price'],
                'qty'=>$prod['qty'],
            ]);
        }

            CustomerCart::whereIn('id', $items['ids'])->delete();
        });
    }
}
