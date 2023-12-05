<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryTransactionData extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'price',
        'qty',
    ];

    public function historyTransaction():BelongsTo{
        return $this->belongsTo(HistoryTransaction::class);
    }
}
