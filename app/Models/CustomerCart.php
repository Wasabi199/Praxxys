<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class CustomerCart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'qty'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    // public function product():BelongsToMany{
    //     return $this->belongsToMany(Product::class);
    // }


    public function scopeCartOwner($query){
        $query->where('user_id',Auth::user()->id)->join('products','customer_carts.product_id','=','products.id')->select('customer_carts.*','price','name');
    }
}
