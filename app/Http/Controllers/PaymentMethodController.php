<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    //
    public function paymentMethod()
    {
        return view('paymentMethod');
    }

    public function payment(Request $req)
    {
        Transaction::where('transaction.id', $req['transactionId'])
            ->update([
                'flag' => 1,
            ]);
        return redirect('/');
    }
}
