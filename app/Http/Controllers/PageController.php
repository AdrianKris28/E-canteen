<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function home()
    {
        $outlet = User::where('role', '=', 'Seller')->get();

        // User::where('id', '=', Auth::user()->id)
        //     ->update([
        //         'tableNumber' => $id,
        //     ]);

        // dd($outlet);
        return view('home', compact('outlet'));
    }


    public function logoutAccount(Request $req)
    {
        Auth::logout();

        return view('auth.login');
    }

    public function menuSeller()
    {
        $product = Product::where('sellerId', '=', Auth::user()->id)->get();
        // dd($product);
        return view('menuSeller', compact('product'));
    }

    public function searchOutlet(Request $req)
    {
        $query = $req['query'];

        $outlet = User::where('user.name', 'LIKE', "%$query%")->where('role', '=', 'Seller')->get();

        return view('home', compact('outlet'));
    }

    public function searchProduct(Request $req)
    {
        $query = $req['query'];

        $product = Product::where('product.name', 'LIKE', "%$query%")->get();

        return view('menuSeller', compact('product'));
    }

    public function menuDetailSeller($id)
    {
        $product = Product::where('id', '=', $id)->get();
        return view('menuDetailSeller', compact('product'));
    }

    public function menuDetailBuyer()
    {

        return view('menuDetailBuyer');
    }

    public function editMenu(Request $req)
    {
        // dd($req);

        $imageLocation = $req['imageOld'];

        $validatedData = $req->validate([
            'name' => ['required', 'string', 'min:5', 'max:25'],
            'description' => ['required', 'string', 'min:10', 'max:100'],
            'price' => ['required', 'integer', 'gte:1000', 'lte:1000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['file'],
        ]);

        if ($req->file('image') != null) {
            $image = $req->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageLocation = 'images/' . $imageName;
            Storage::putFileAs('public/images', $image, $imageName);
        }

        Product::where('product.id', '=', $req['productId'])
            ->update([
                'sellerId' => Auth::user()->id,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'image' => $imageLocation,
            ]);

        return redirect('/menuSeller');
    }

    public function deleteMenu($id)
    {
        Product::where('id', '=', $id)->delete();
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
            'price' => ['required', 'integer', 'gte:1000', 'lte:1000000'],
            'stock' => ['required', 'integer', 'gte:1'],
            'image' => ['required', 'file'],
        ]);

        //Connect storage
        // php artisan storage:link

        $image = $req->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imageLocation = 'images/' . $imageName;
        Storage::putFileAs('public/images', $image, $imageName);
        Product::create([
            'sellerId' => Auth::user()->id,
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image' => $imageLocation,
        ]);

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
