<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    //
    public function account()
    {
        $data = User::where('id', '=', Auth::user()->id)->get();
        // dd($data);
        return view('account', compact('data'));
    }

    public function editProfile(Request $req)
    {
        // dd($req->file('image'));

        //Connect storage
        // php artisan storage:link

        $req->validate([
            'email' => ['required', 'string', 'email', 'unique:users'],
        ]);


        if ($req['password'] == Auth::user()->password) {
            $updatedPassword = $req['password'];
        } else {
            $updatedPassword = Hash::make($req['password']);
        }

        if (Auth::user()->role == 'Seller') {

            $imageLocation = $req['imageOld'];

            if ($req->file('image') != null) {
                $image = $req->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imageLocation = 'images/' . $imageName;
                Storage::putFileAs('public/images', $image, $imageName);
            }

            User::where('id', '=', Auth::user()->id)
                ->update([
                    'email' => $req['email'],
                    'password' => $updatedPassword,
                    'phone' => $req['phonenumber'],
                    'image' => $imageLocation,
                ]);
        }

        if (Auth::user()->role == 'Buyer') {
            User::where('id', '=', Auth::user()->id)
                ->update([
                    'email' => $req['email'],
                    'password' => $updatedPassword,
                    'phone' => $req['phonenumber'],
                ]);
        }

        return redirect('/account');
    }
}
