<?php

namespace App\Http\Controllers;

use App\Http\Requests\checkOutFormRequest;
use App\Services\PaymentInstance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckOutController extends Controller
{
    //


    public function checkout(checkOutFormRequest $request)
    {
        $validated_data = $request->validated();
        $link =  PaymentInstance::getPaymentInstance($validated_data);
        return Inertia::location($link);
    }



    public function success()
    {
        return Inertia::render('PraxxysCustomer/Transactions/Success');
    }

    public function failure()
    {
        return Inertia::render('PraxxysCustomer/Transactions/Failure');
    }

    public function canceled()
    {
        return Inertia::render('PraxxysCustomer/Transactions/Canceled');
    }
}
