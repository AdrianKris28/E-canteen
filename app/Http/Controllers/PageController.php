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
use Illuminate\Support\Facades\DB;
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

        $product = Product::where('product.name', 'LIKE', "%$query%")
            ->where('sellerId', '=', Auth::user()->id)
            ->get();

        return view('menuSeller', compact('product'));
    }

    public function searchProductOutlet(Request $req)
    {
        // dd($req);
        $query = $req['query'];

        $product = Product::where('product.name', 'LIKE', "%$query%")
            ->where('product.sellerId', '=', $req['outletId'])->get();

        $totalHarga = Product::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->where('product.sellerId', '=', $req['outletId'])->value('totalHarga');

        if ($totalHarga == null) {
            $totalHarga = 0;
        }

        $id = $req['outletId'];

        $transactionId = Transaction::join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('product.sellerId', '=', $req['outletId'])
            ->first('transaction.id');

        $tableNumber = Transaction::join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->where('product.sellerId', '=', $id)
            ->value('transaction.tableNumber');

        if ($tableNumber == null) {
            $tableNumber = 0;
        }

        $namaOutlet = User::where('id', '=', $req['outletId'])->value('name');

        return view('insideOutlet', compact('product', 'totalHarga', 'id', 'namaOutlet', 'transactionId', 'tableNumber'));
    }

    public function menuDetailSeller($id)
    {
        $product = Product::where('id', '=', $id)->get();
        return view('menuDetailSeller', compact('product'));
    }

    public function menuDetailBuyer($id)
    {
        $product = Product::where('product.id', '=', $id)
            ->get();

        $qty = TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transactiondetail.productId', '=', $id)
            ->where('transaction.flag', 0)
            ->where('transaction.buyerId', Auth::user()->id)
            ->value('transactiondetail.qty');


        if ($qty == null) {
            $qty = 0;
        }

        $stock = TransactionDetail::join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transactiondetail.productId', '=', $id)
            ->value('product.stock');

        // dd($qty);


        return view('menuDetailBuyer', compact('product', 'qty', 'stock'));
    }

    public function insideOutlet($id)
    {
        $namaOutlet = User::where('id', '=', $id)->value('name');

        $product = Product::where('sellerId', '=', $id)
            ->where('stock', '!=', 0)
            ->get();

        $totalHarga = Product::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->where('product.sellerId', '=', $id)->value('totalHarga');

        if ($totalHarga == null) {
            $totalHarga = 0;
        }

        $transactionId = Transaction::join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->where('product.sellerId', '=', $id)
            ->value('transaction.id');

        // dd($transactionId);

        $tableNumber = Transaction::join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->where('product.sellerId', '=', $id)
            ->value('transaction.tableNumber');

        if ($tableNumber == null) {
            $tableNumber = 0;
        }

        // dd($transactionId);

        return view('insideOutlet', compact('product', 'totalHarga', 'id', 'namaOutlet', 'transactionId', 'tableNumber'));
    }

    public function addToCart(Request $req)
    {
        //masih perlu di cek

        $outletId = $req['outletId'];

        $productId = $req['productId'];
        // $date = new DateTime('now');

        $currentDateTime = Carbon::now()->toDateTimeString();

        // dd($outletId);

        $tid = Transaction::select('transaction.id')->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
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
            Transaction::where('transaction.id', $tid)
                ->where('transaction.buyerId', '=', Auth::user()->id)
                ->where('transaction.flag', 0)
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
            ->where('transaction.flag', 0)
            ->value('id');

        // dd($currentDateTime, $transactionId);

        if (
            TransactionDetail::withTrashed()->select('productId')->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('productId', '=', $req['productId'])
            ->where('buyerId', '=', Auth::user()->id)
            ->where('transaction.flag', 0)
            ->value('productId') != null
        ) {
            TransactionDetail::withTrashed()->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
                ->where('productId', '=', $req['productId'])
                ->where('transaction.flag', 0)
                ->where('buyerId', '=', Auth::user()->id)->restore();

            TransactionDetail::join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
                ->where('productId', '=', $req['productId'])
                ->where('transaction.flag', 0)
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

    public function searchSales(Request $req)
    {

        $product = Product::select(DB::raw('SUM(transactiondetail.qty) as productSales, product.id, product.name, product.image'))
            ->leftJoin('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('product.sellerId', Auth::user()->id)
            ->where('transaction.flag', '>', 0)
            ->where('transaction.transactionDate', '>=', $req['startdate'])
            ->where('transaction.transactionDate', '<=', $req['enddate'])
            ->groupBy(['product.id', 'product.name', 'product.image'])->get();

        $totalSales = Product::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalSales'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('product.sellerId', Auth::user()->id)
            ->where('transaction.flag', '>', 0)
            ->where('transaction.transactionDate', '>=', $req['startdate'])
            ->where('transaction.transactionDate', '<=', $req['enddate'])
            ->value('totalSales');

        if ($totalSales == null) {
            $totalSales = 0;
        }

        return view('salesSeller', compact('product', 'totalSales'));
    }

    public function salesSeller()
    {
        $currentDate = date('Y-m-d');

        $product = Product::select(DB::raw('SUM(transactiondetail.qty) as productSales, product.id, product.name, product.image'))
            ->leftJoin('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('product.sellerId', Auth::user()->id)
            ->where('transaction.flag', '>', 0)
            ->where('transaction.transactionDate', $currentDate)
            ->groupBy(['product.id', 'product.name', 'product.image'])->get();

        $totalSales = Product::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalSales'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('product.sellerId', Auth::user()->id)
            ->where('transaction.flag', '>', 0)
            ->where('transaction.transactionDate', $currentDate)
            ->value('totalSales');

        if ($totalSales == null) {
            $totalSales = 0;
        }
        // dd($product);
        return view('salesSeller', compact('product', 'totalSales'));
    }

    public function transactionHistorySeller()
    {

        $currentDate = date('Y-m-d');

        // $data = Transaction::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga, transaction.id, transaction.transactionDate, transaction.flag, users.image'))
        //     ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
        //     ->join('product', 'product.id', '=', 'transactiondetail.productId')
        //     ->join('users', 'users.id', '=', 'product.sellerId')
        //     ->where('transaction.buyerId', Auth::user()->id)
        //     ->where('transaction.transactionDate', $currentDate)
        //     ->where('transaction.flag', '=', 3)
        //     ->groupBy(['transaction.id', 'transaction.transactionDate', 'transaction.flag', 'users.image'])->get();



        $data = Transaction::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga, transaction.id, transaction.transactionDate, transaction.flag'))
            ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->where('transaction.flag', '=', 3)
            ->where('product.sellerId', Auth::user()->id)
            ->groupBy(['transaction.id', 'transaction.transactionDate', 'transaction.flag'])
            ->orderBy('transaction.updated_at', 'ASC')->get();



        // dd($data);
        return view('transactionHistorySeller', compact('data'));
    }

    public function transactionHistoryDetailSeller($id)
    {
        $outlet = Transaction::select(DB::raw('transaction.id, transaction.transactionDate,  users.name as storeName, SUM(transactiondetail.qty * product.price) as totalHarga, transaction.flag, users.image'))
            ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->join('users', 'users.id', '=', 'product.sellerId')
            ->where('transaction.id', $id)
            ->groupBy(['transaction.id', 'transaction.transactionDate', 'users.name', 'users.image', 'transaction.flag'])->first();

        $product = Product::select(DB::raw('transactiondetail.transactionId, product.id as productId, product.name as productName, product.price, transactiondetail.qty, product.image'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.id', $id)->get();

        // dd($product);

        return view('transactionHistoryDetailSeller', compact('outlet', 'product'));
    }

    public function transactionHistoryBuyer()
    {
        $currentDate = date('Y-m-d');

        $data = Transaction::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga, transaction.id, transaction.transactionDate, transaction.flag, users.image'))
            ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->join('users', 'users.id', '=', 'product.sellerId')
            ->where('transaction.buyerId', Auth::user()->id)
            ->where('transaction.transactionDate', $currentDate)
            ->where('transaction.flag', '!=', 0)
            ->groupBy(['transaction.id', 'transaction.transactionDate', 'transaction.flag', 'users.image'])->get();

        // dd($data);
        return view('transactionHistoryBuyer', compact('data'));
    }

    public function searchHistory(Request $req)
    {
        // dd($data);

        if (Auth::user()->role == 'Buyer') {
            $data = Transaction::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga, transaction.id, transaction.transactionDate, transaction.flag, users.image'))
                ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
                ->join('product', 'product.id', '=', 'transactiondetail.productId')
                ->join('users', 'users.id', '=', 'product.sellerId')
                ->where('transaction.buyerId', Auth::user()->id)
                ->where('transactionDate', '>=', $req['startdate'])
                ->where('transactionDate', '<=', $req['enddate'])
                ->groupBy(['transaction.id', 'transaction.transactionDate', 'transaction.flag', 'users.image'])->get();

            return view('transactionHistoryBuyer', compact('data'));
        } else {

            $data = Transaction::select(DB::raw('SUM(transactiondetail.qty * product.price) as totalHarga, transaction.id, transaction.transactionDate, transaction.flag'))
                ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
                ->join('product', 'product.id', '=', 'transactiondetail.productId')
                ->where('transaction.flag', '=', 3)
                ->where('product.sellerId', Auth::user()->id)
                ->where('transactionDate', '>=', $req['startdate'])
                ->where('transactionDate', '<=', $req['enddate'])
                ->groupBy(['transaction.id', 'transaction.transactionDate', 'transaction.flag'])
                ->orderBy('transaction.updated_at', 'ASC')->get();

            return view('transactionHistorySeller', compact('data'));
        }
    }

    public function transactionHistoryDetailBuyer($id)
    {
        $outlet = Transaction::select(DB::raw('transaction.id, transaction.transactionDate,  users.name as storeName, SUM(transactiondetail.qty * product.price) as totalHarga, transaction.flag, users.image'))
            ->join('transactiondetail', 'transactiondetail.transactionId', '=', 'transaction.id')
            ->join('product', 'product.id', '=', 'transactiondetail.productId')
            ->join('users', 'users.id', '=', 'product.sellerId')
            ->where('transaction.id', $id)
            ->groupBy(['transaction.id', 'transaction.transactionDate', 'users.name', 'users.image', 'transaction.flag'])->first();

        $product = Product::select(DB::raw('transactiondetail.transactionId, product.id as productId, product.name as productName, product.price, transactiondetail.qty, product.image'))
            ->join('transactiondetail', 'transactiondetail.productId', '=', 'product.id')
            ->join('transaction', 'transaction.id', '=', 'transactiondetail.transactionId')
            ->where('transaction.buyerId', Auth::user()->id)->get();

        // dd($product);

        return view('transactionHistoryDetailBuyer', compact('outlet', 'product'));
    }
}
