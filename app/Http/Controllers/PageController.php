<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function homepage()
    {
        $outlet = User::where('role', '=', 'Seller')->get();
        // dd($outlet);

        if (Auth::check()) {
            return view('home', compact('outlet'));
        } else {
            return view('auth.login');
        }
    }

    // public function home($id)
    // {
    //     $outlet = User::where('role', '=', 'Seller')->get();

    //     if (Auth::check()) {
    //         User::where('id', '=', Auth::user()->id)
    //             ->update([
    //                 'tableNumber' => $id,
    //             ]);
    //     }
    //     // dd($outlet);
    //     return view('home', compact('outlet'));
    // }


    public function logoutAccount(Request $req)
    {
        Auth::logout();

        return redirect('/');
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

        $outlet = User::where('name', 'LIKE', "%$query%")->where('role', '=', 'Seller')->get();

        return view('home', compact('outlet'));
    }

    public function searchProduct(Request $req)
    {
        $query = $req['query'];

        $product = Product::where('product.name', 'LIKE', "%$query%")->get();

        return view('menuSeller', compact('product'));
    }

    public function searchProductOutlet(Request $req)
    {
        $query = $req['query'];

        $product = Product::where('product.name', 'LIKE', "%$query%")->get();

        return view('insideOutlet', compact('product'));
    }

    public function menuDetailSeller($id)
    {
        $product = Product::where('id', '=', $id)->get();
        return view('menuDetailSeller', compact('product'));
    }

    public function menuDetailBuyer($id)
    {
        $product = Product::where('id', '=', $id)->get();
        return view('menuDetailBuyer', compact('product'));
    }

    public function insideOutlet($id)
    {
        $product = Product::leftJoin('transactiondetail', 'transactiondetail.productId', '=', 'product.id')->where('sellerId', '=', $id)->get();

        // gajadi dipake
        // $totalHarga = Product::select(DB::raw('transactiondetail.qty * product.price as totalHarga'))
        // ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
        // ->where('sellerId', '=', $id)->value('totalHarga');

        // $outlet = Product::join('users', 'product.sellerId', '=', 'users.id')
        //     ->where('sellerId', '=', $id)->get();

        // $outlet = User::where('id', '=', $id)->get();

        // dd($product);
        return view('insideOutlet', compact('product'));
    }

    public function addToCart(Request $req)
    {
        //masih perlu di cek

        $outletId = $req['outletId'];
        // $date = new DateTime('now');

        $currentDateTime = Carbon::now()->toDateTimeString();

        // dd($sellerId);

        $tid = Transaction::select('transaction.id')->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('product.sellerId', '=', $outletId)
            ->value('transaction.id');

        // dd($tid);

        // NOTE
        // ini masih ada bug harusnya (waktu add to cart di lebih dari satu outlet, data di table transaction ke update trs)
        // hrs tambahin kondisi kalo sellernya beda baru insert data baru ke table transaction
        // --> Solved

        if ($tid == null) {
            Transaction::create([
                'buyerId' => Auth::user()->id,
                'flag' => 0,
                'transactionDate' => $currentDateTime,
            ]);
        } else {
            Transaction::where('buyerId', '=', Auth::user()->id)
                ->update([
                    'buyerId' => Auth::user()->id,
                    'flag' => 0,
                    'transactionDate' => $currentDateTime,
                    'created_at' => $currentDateTime,
                ]);
        }

        $transactionId = Transaction::select('id')
            ->where('transaction.created_at', '=', $currentDateTime)
            ->where('buyerId', '=', Auth::user()->id)
            ->value('id');

        // dd($transactionId);

        if (
            TransactionDetail::select('productId')->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('productId', '=', $req['productId'])
            ->where('buyerId', '=', Auth::user()->id)->value('productId') != null
        ) {
            TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
                ->where('productId', '=', $req['productId'])
                ->where('buyerId', '=', Auth::user()->id)
                ->update([
                    'transactionId' => $transactionId,
                    'productId' => $req['productId'],
                    'qty' => $req['quantity'],
                ]);
        } else {
            TransactionDetail::create([
                'transactionId' => $transactionId,
                'productId' => $req['productId'],
                'qty' => $req['quantity'],
            ]);
        }

        return redirect('/insideOutlet/' . $outletId);
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
}
