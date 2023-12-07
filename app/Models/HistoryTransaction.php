<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HistoryTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'checkout_id',
        'checkout_link',
        'total_price',
        'payment_method'
    ];

    public function historyTransactionData():HasMany{
        return $this->hasMany(HistoryTransactionData::class);
    }
}
