<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
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
        // dd($req);
        Transaction::where('transaction.id', $req['transactionId'])
            ->update([
                'flag' => 1,
                'orderType' => $req['orderType'],
            ]);

        $outlet = User::where('role', '=', 'Seller')->get();

        // return view('home', compact('outlet'));
        return redirect('/');
    }
}
