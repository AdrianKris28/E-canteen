@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/menu-detail-buyer.css') }}">
@endsection


@section('content')
        
     <form action="/addToCart" method="post">
        @csrf
        @foreach ($product as $pd)
        <input type="hidden" name="productId" value="{{$pd->id}}">
        <input type="hidden" name="outletId" value="{{$pd->sellerId}}">

        <img src="{{ Storage::url($pd->image)}}" style="width: 100%;height: 300px" alt="Gambar">
            
        <div style="margin-top: 30px">
            <div>
                <h2 style="margin-left: 9px">{{$pd->name}}</h2>
                <h2 style="margin-left: 10px">Rp. @convert($pd->price)</h2>
            </div>
            <p style="margin-left: 10px">{{$pd->description}}</p>
        </div>
        
        {{-- <div style="text-align: center;margin-top: 100px">
            <label for="quantity"><h5>Quantity:</h5></label>
                <input type="number" name="quantity" id="quantity" value="{{$qty}}" style="width:50px;text-align: center;border: 0" min="1" max="{{$stock}}">

        </div> --}}

        <div style="text-align: center;margin-top: 50px" class="menu-detail-group cart-qty">
            {{-- <label for="stock"><h5>Stock:</h5></label>
            <input type="number" name="stock" id="stock" value="{{$pd->stock}}" style="width:50px;text-align: center;border: 0" min="1"> --}}
            <label for="quantity"><h5>Quantity:</h5></label>
            <br>
            <button type='button' value='-' class='qtyminus minus btn' field='quantity'>-</button>
            <input type='number' name="quantity" id="stock" value="{{$qty}}" style="width:50px;text-align: center;border: 0" class='qty' min="1" max="{{$stock}}" readonly>
            <button type='button' value='+' class='qtyplus plus btn' field='quantity'>+</button>
       
        </div>
            
            
        @endforeach

        <button type="submit" class="btn" id="add-to-cart-btn" style="display: flex;margin: auto;padding: 10px 40px 10px 40px;margin-top: 20px">Add to Cart</button>

        </form>
    

@endsection

@section('javascript')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
