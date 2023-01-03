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

    public function menuSeller()
    {

        return view('menuSeller');
    }

    public function menuDetailSeller()
    {

        return view('menuDetailSeller');
    }

    public function menuDetailBuyer()
    {

        return view('menuDetailBuyer');
    }

    public function editMenu(Request $req)
    {

        return redirect('/menuSeller');
    }

    public function cartBuyer(Request $req)
    {

        return view('/cartBuyer');
    }


    public function addNewProductSeller()
    {

        return view('addNewProductSeller');
    }

    public function addProduct(Request $req)
    {
        // dd($req->file('image'));
        $validatedData = $req->validate([
            'name' => ['required', 'string', 'min:5', 'max:25'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'price' => ['required', 'integer', 'gte:1000', 'lte:10000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['required', 'file'],
        ]);

        //Connect storage
        // php artisan storage::link

        // $image = $req->file('image');
        // $imageName = time() . '.' . $image->getClientOriginalExtension();
        // $imageLocation = 'images/' . $imageName;
        // Storage::putFileAs('public/images', $image, $imageName);
        // Product::create([
        //     'category' => $validatedData['category'],
        //     'title' => $validatedData['title'],
        //     'description' => $validatedData['description'],
        //     'price' => $validatedData['price'],
        //     'stock' => $validatedData['stock'],
        //     'image' => $imageLocation,
        // ]);

        return redirect('/menuSeller');
    }

    public function salesSeller()
    {

        return view('salesSeller');
    }

    public function transactionHistorySeller()
    {

        return view('transactionHistorySeller');
    }

    public function transactionHistoryDetailSeller()
    {
        return view('transactionHistoryDetailSeller');
    }

    public function transactionHistoryBuyer()
    {
        return view('transactionHistoryBuyer');
    }

    public function transactionHistoryDetailBuyer()
    {
        return view('transactionHistoryDetailBuyer');
    }

    public function insideOutlet()
    {
        return view('insideOutlet');
    }
}
