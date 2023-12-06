<?php

namespace App\Services;

use App\Helpers\Method\PayMaya;
use App\Helpers\Service\ItemService;
use App\Helpers\Service\TransactionService;

class PaymentInstance
{
    public static function getPaymentInstance($paymentMethod, $validated_data)
    {
        switch($paymentMethod){
            case 'Paymaya':
                $payment = new PayMaya(new ItemService, new TransactionService);
                $link = $payment->checkOut($validated_data);
                return $link;
                break;
            default:
                break;
        }
    }
}
