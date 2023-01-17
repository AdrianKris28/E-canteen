<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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
        $count = 0;

        foreach ($req['productId'] as $pd) {

            $stock = Product::where('product.id', $pd)->value('stock');

            TransactionDetail::where('transactiondetail.productId', $pd)
                ->where('transactiondetail.transactionId', $req['transactionId'])
                ->update([
                    'qty' => $req['quantity.' . $count],
                ]);

            Product::where('product.id', $pd)
                ->update([
                    'stock' => $stock - $req['quantity.' . $count],
                ]);

            $count++;
        }


        $json = json_decode($req['json']);
        // dd($json->transaction_status);

        if ($json->transaction_status == 'settlement') {
            Transaction::where('transaction.id', $req['transactionId'])
                ->update([
                    'flag' => 1,
                    'orderType' => $req['orderType'],
                    'paymentMethod' => $json->payment_type,
                ]);
            return redirect('/')->with('alert-success', 'Your transaction will be forwarded to seller');
        }

        $outlet = User::where('role', '=', 'Seller')->get();

        // return view('home', compact('outlet'));
    }
}
