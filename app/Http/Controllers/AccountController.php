<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    public function account()
    {
        $data = User::where('id', '=', Auth::user()->id);
        // dd($data);
        return view('account', compact('data'));
    }
}
