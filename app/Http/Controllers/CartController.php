<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\deleteCartItemFormRequest;
use App\Http\Requests\QtyActionRequest;
use App\Models\CustomerCart;
use App\Models\PaymentGateway;
use App\Models\Product;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CartController extends Controller
{
    //

    public function addToCart(AddToCartRequest $request)
    {
        $validated_data = $request->validated();
        $user = User::findOrFail(Auth::user()->id);
        $product = Product::findOrFail($validated_data['product_id']);
        DB::transaction(function () use ($validated_data, $user, $product) {
            $user->customerCart()->create([
                'product_id' => $validated_data['product_id'],
                'price' => $product->price
            ]);
        });

        return Redirect::back()->with('message', [NotificationService::notificationItem('success', '', 'Add to Cart Successful')]);
    }


    public function cart()
    {
        $customerCart = CustomerCart::cartOwner(Auth::user()->id)->limit(5)->paginate(5);
        $gateway_payment = PaymentGateway::all();
        return Inertia::render('PraxxysCustomer/CustomerCart', [
            'CustomerCart' => $customerCart,
            'GatewayPayment' => $gateway_payment
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
}
