<?php

namespace App\Services;

use App\Helpers\Service\ItemService;
use App\Helpers\Service\TransactionService;

class PaymentInstance
{
    public static function getPaymentInstance($validated_data)
    {
        $payment_method = 'App\\Helpers\\Method\\'.$validated_data['payment_method'];
        
        $payment = new $payment_method(new ItemService, new TransactionService);
        $link = $payment->checkOut($validated_data);
        return $link;
    }
}
