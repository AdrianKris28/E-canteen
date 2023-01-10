<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function plusQuantity($transactionId, $productId)
    {

        $qty = TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.id', $transactionId)
            ->where('transactiondetail.productId', $productId)->value('transactiondetail.qty');

        TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.id', $transactionId)
            ->where('transactiondetail.productId', $productId)
            ->update([
                'qty' => $qty + 1,
            ]);

        return redirect('/cartPage');
    }

    public function minusQuantity($transactionId, $productId)
    {

        $qty = TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.id', $transactionId)
            ->where('transactiondetail.productId', $productId)->value('transactiondetail.qty');

        TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.id', $transactionId)
            ->where('transactiondetail.productId', $productId)
            ->update([
                'qty' => $qty - 1,
            ]);

        return redirect('/cartPage');
    }


    public function cart(Request $req)
    {
        $req->validate([
            'transactionId' => ['required'],
        ]);

        Transaction::where('id', $req['transactionId'])
            ->update([
                'tableNumber' => $req['tableNumber'],
            ]);

        $product = Product::select(DB::raw('product.id as productId, product.name as productName, product.price, transactiondetail.qty, product.image,product.sellerId'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.buyerId', Auth::user()->id)
            ->where('transaction.flag', 0)
            // ->groupBy('product.id, product.name, product.price, transactiondetail.qty')
            ->get();

        $outlet = Product::join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->join('users', 'users.id', '=', 'product.sellerId')
            ->where('transaction.buyerId', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->groupBy(['product.sellerId', 'users.name', 'transaction.id'])
            ->get(['product.sellerId', 'users.name', 'transaction.id as transactionId']);



        // dd($outlet);
        return view('cart', compact('product', 'outlet'));
    }

    public function cartPage()
    {
        $product = Product::select(DB::raw('product.id as productId, product.name as productName, product.price, transactiondetail.qty, product.image,product.sellerId'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.buyerId', Auth::user()->id)
            ->where('transaction.flag', 0)
            // ->groupBy('product.id, product.name, product.price, transactiondetail.qty')
            ->get();

        $outlet = Product::join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->join('users', 'users.id', '=', 'product.sellerId')
            ->where('transaction.buyerId', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->groupBy(['product.sellerId', 'users.name', 'transaction.id'])
            ->get(['product.sellerId', 'users.name', 'transaction.id as transactionId']);

        // dd($outlet);
        return view('cart', compact('product', 'outlet'));
    }

    public function checkoutCart(Request $req)
    {
        // dd($req);

        $count = 0;
        foreach ($req['productId'] as $pd) {

            TransactionDetail::where('transactiondetail.productId', $pd)
                ->where('transactiondetail.transactionId', $req['transactionId'])
                ->update([
                    'qty' => $req['quantity.' . $count],
                ]);

            $count++;
        }

        return redirect('/paymentMethod');
    }
}
