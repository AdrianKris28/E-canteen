<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    //
    public function paymentMethod(){
        return view('paymentMethod');
    }
}
