<?php

namespace App\Http\Controllers;

use App\Models\HistoryTransaction as ModelsHistoryTransaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HistoryTransaction extends Controller
{
    //
    public function historyTransaction()
    {
        $history = ModelsHistoryTransaction::orderBy('created_at','DESC')->limit(10)->paginate(10);
        return Inertia::render('PraxxysCustomer/HistoryTransaction', [
            'History' => $history
        ]);
    }
}
