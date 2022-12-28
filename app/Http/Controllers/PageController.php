<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function logoutAccount(Request $req)
    {
        Auth::logout();

        return view('auth.login');
    }
}
