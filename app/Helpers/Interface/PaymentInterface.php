<?php

namespace App\Helpers\Interface;


interface PaymentInterface
{
    public function checkOut($validated_data);
}
