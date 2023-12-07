<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    //

    public function index()
    {
        if (Auth::user()->usertype == 1) {
            return Inertia::render('Praxxys/Dashboard');
        } else if (Auth::user()->usertype == 2) {
            $products = Product::with('productImage')->with('productImage')->limit(20)->paginate(20);
            return Inertia::render('PraxxysCustomer/EcomerceView', [
                'Products' => $products
            ]);
        } else {
            return Redirect::route('/login');
        }
    }
}
