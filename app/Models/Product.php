<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'description',
        'date',
        'time',
        'price'
    ];

    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    // public function customerCart():HasMany{
    //     return $this->hasMany(CustomerCart::class);
    // }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where(function ($query) use ($category) {
                $query->where('category', $category);
            });
        });
    }
}
