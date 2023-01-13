<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function incomingOrder(){
        
        $data = Transaction::select(DB::raw('transaction.id, transaction.buyerId, transaction.flag, transaction.orderType, transaction.tableNumber, transaction.transactionDate, SUM(transactiondetail.qty * product.price) as totalHarga, transaction.updated_at'))
        ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
        ->join('product', 'product.id', '=', 'transactiondetail.productId')
        ->where('transaction.flag', '=', 1)
        ->where('product.sellerId', Auth::user()->id)
        ->groupBy(['transaction.id', 'transaction.buyerId', 'transaction.flag', 'transaction.orderType', 'transaction.tableNumber', 'transaction.transactionDate', 'transaction.updated_at'])
        ->orderBy('transaction.updated_at', 'ASC')->get();

        $countData = Transaction::select(DB::raw('transactiondetail.transactionId, product.id, product.name, transactionDetail.qty, product.price'))
        ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
        ->join('product', 'product.id', '=', 'transactiondetail.productId')
        ->where('transaction.flag', '=', 1)
        ->where('product.sellerId', Auth::user()->id)->get();

        return view('incomingOrder', compact('data', 'countData'));
    }

    public function acceptedOrder(){

        $data = Transaction::select(DB::raw('transaction.id, transaction.buyerId, transaction.flag, transaction.orderType, transaction.tableNumber, transaction.transactionDate, SUM(transactiondetail.qty * product.price) as totalHarga, transaction.updated_at'))
        ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
        ->join('product', 'product.id', '=', 'transactiondetail.productId')
        ->where('transaction.flag', '=', 2)
        ->where('product.sellerId', Auth::user()->id)
        ->groupBy(['transaction.id', 'transaction.buyerId', 'transaction.flag', 'transaction.orderType', 'transaction.tableNumber', 'transaction.transactionDate', 'transaction.updated_at'])
        ->orderBy('transaction.updated_at', 'ASC')->get();

        $countData = Transaction::select(DB::raw('transactiondetail.transactionId, product.id, product.name, transactionDetail.qty, product.price'))
        ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
        ->join('product', 'product.id', '=', 'transactiondetail.productId')
        ->where('transaction.flag', '=', 2)
        ->where('product.sellerId', Auth::user()->id)->get();

        return view('acceptedOrder', compact('data', 'countData'));
    }

    public function acceptOrder(Request $req)
    {
        Transaction::where('transaction.id', $req['transactionId'])
            ->update([
                'flag' => 2,
            ]);
        return redirect('/acceptedOrder');
    }

    public function finishDelivery(Request $req)
    {
        Transaction::where('transaction.id', $req['transactionId'])
            ->update([
                'flag' => 3,
            ]);
        return redirect('/acceptedOrder');
    }
}
