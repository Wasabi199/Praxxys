<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Lloricode\Paymaya\Client\Checkout\CheckoutClient;
use Lloricode\Paymaya\PaymayaClient;
use Lloricode\Paymaya\Request\Checkout\Amount\AmountDetail;
use Lloricode\Paymaya\Request\Checkout\Amount\Amount;
use Lloricode\Paymaya\Request\Checkout\Buyer\BillingAddress;
use Lloricode\Paymaya\Request\Checkout\Buyer\Buyer;
use Lloricode\Paymaya\Request\Checkout\Buyer\Contact;
use Lloricode\Paymaya\Request\Checkout\Buyer\ShippingAddress;
use Lloricode\Paymaya\Request\Checkout\Checkout;
use Lloricode\Paymaya\Request\Checkout\Item;
use Lloricode\Paymaya\Request\Checkout\MetaData;
use Lloricode\Paymaya\Request\Checkout\RedirectUrl;
use Lloricode\Paymaya\Request\Checkout\TotalAmount;

class PaymentService
{
    public static function CheckOut($data)
    {
        // dd($data);
        // $item = [];

        // foreach($data['products'] as $product){

        // }
        try {
            $checkout = (new Checkout())
                ->setTotalAmount(
                    (new TotalAmount())
                        ->setValue($data['total'])
                 
                )->setRedirectUrl(
                    (new RedirectUrl())
                        ->setSuccess('https://www.merchantsite.com/success')
                        ->setFailure('https://www.merchantsite.com/failure')
                        ->setCancel('https://www.merchantsite.com/cancel')
                )->setRequestReferenceNumber('1551191039')
                ->setMetadata(
                    (new MetaData())
                        ->setSMI('smi')
                        ->setSMN('smn')
                        ->setMCI('mci')
                        ->setMPC('mpc')
                        ->setMCO('mco')
                        ->setMST('mst')
                );

            $checkoutResponse = (new CheckoutClient(
                new PaymayaClient(
                    env("PAYMAYA_SECRET_KEY"), // secret
                    env("PAYMAYA_PUBLIC_KEY"), // public
                    PaymayaClient::ENVIRONMENT_SANDBOX
                )
            ))->execute($checkout);

            // dd($checkoutResponse);
            return$checkoutResponse->redirectUrl;

            // echo 'id: ' . $checkoutResponse->checkoutId . "\n";
            // echo 'url: ' . $checkoutResponse->redirectUrl . "\n";


        } catch (\Throwable $th) {
            Log::channel('payment_service')->error($th);
        }
    }
}
