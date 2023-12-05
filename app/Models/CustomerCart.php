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
        'qty',
        'price'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function product():BelongsToMany{
    //     return $this->belongsToMany(Product::class);
    // }


    public function scopeCartOwner($query,$id)
    {
        $query->where('user_id', Auth::user()->id)->join('products', function ($query) {
            $query->on('customer_carts.product_id', '=', 'products.id')
                ->join('product_images', 'products.id', '=', 'product_images.product_id');
        })->select('customer_carts.*', 'name', 'filename');
    }
}
