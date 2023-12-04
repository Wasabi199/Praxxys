<?php

namespace App\Http\Controllers;

use App\Helpers\PaymentService as HelpersPaymentService;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\checkOutFormRequest;
use App\Http\Requests\deleteCartItemFormRequest;
use App\Http\Requests\QtyActionRequest;
use App\Models\CustomerCart;
use App\Models\HistoryTransaction;
use App\Models\User;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use PaymentService;

class CustomerController extends Controller
{
    //

    public function addToCart(AddToCartRequest $request)
    {
        $validated_data = $request->validated();
        $user = User::findOrFail(Auth::user()->id);
        DB::transaction(function () use ($validated_data, $user) {
            $user->customerCart()->create([
                'product_id' => $validated_data['product_id']
            ]);
        });

        return Redirect::back()->with('message', [NotificationService::notificationItem('success', '', 'Add to Cart Successful')]);
    }


    public function cart()
    {
        $customerCart = CustomerCart::cartOwner()->limit(5)->paginate(5);
        return Inertia::render('PraxxysCustomer/CustomerCart', [
            'CustomerCart' => $customerCart
        ]);
    }

    public function qtyAction(QtyActionRequest $request)
    {
        $validated_data = $request->validated();
        $customerCart = CustomerCart::findOrFail($validated_data['id']);
        DB::transaction(function () use ($validated_data, $customerCart) {
            $customerCart->update([
                'qty' => $validated_data['qty']
            ]);
        });

        return Redirect::back();
    }

    public function deleteCartItem(deleteCartItemFormRequest $request)
    {
        $validated_data = $request->validated();

        DB::transaction(function () use ($validated_data) {
            $cutomerCart = CustomerCart::findOrFail($validated_data['id']);
            $cutomerCart->delete();
        });


        return Redirect::back()->with('message', [NotificationService::notificationItem('success', '', 'Delete item from Cart Successful')]);
    }

    public function checkout(checkOutFormRequest $request)
    {
        $validated_data = $request->validated();

        $link = HelpersPaymentService::CheckOut($validated_data);

        return Redirect::away($link);
    }

    public function historyTransaction()
    {
        $history = HistoryTransaction::limit(10)->paginate(10);
        return Inertia::render('PraxxysCustomer/HistoryTransaction', [
            'History' => $history
        ]);
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
