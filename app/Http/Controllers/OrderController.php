<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function incomingOrder(){
        return view('incomingOrder');
    }

    public function acceptedOrder(){
        return view('acceptedOrder');
    }
}
