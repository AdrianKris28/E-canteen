@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/menu-detail-seller.css') }}">
@endsection


@section('content')
    <form action="/editMenu" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach ($product as $pd)

        <input type="hidden" name="productId" value="{{$pd->id}}">
        <input type="hidden" name="imageOld" value="{{$pd->image}}">

        <img src="{{ Storage::url($pd->image)}}" style="width: 100%;height: 300px" alt="Gambar">
            
        <div style="margin-top: 30px" class="menu-detail-group">
            <div>
                <p style="margin-left: 9px"><input type="text" name="name" style="border: 0" value="{{$pd->name}}"></p>
                <p style="margin-left: 10px" class="price">Rp. <input type="number" class="price" name="price" style="border: 0" value="{{$pd->price}}" min="1"></p>
            </div>
        
            <textarea name="description" id="description" cols="30" rows="5" style="margin-left: 9px;border: 0" value="{{$pd->description}}">{{$pd->description}}</textarea>
        
            <input id="image" type="file" accept=".png, .jpeg, .jpg" class="form-control @error('image') is-invalid @enderror" name="image" style="border: none">
            
        </div>
        
        <div style="text-align: center;margin-top: 20px" class="menu-detail-group cart-qty">
            {{-- <label for="stock"><h5>Stock:</h5></label>
            <input type="number" name="stock" id="stock" value="{{$pd->stock}}" style="width:50px;text-align: center;border: 0" min="1"> --}}
            <label for="stock"><h5>Stock:</h5></label>
            <br>
            <button type='button' value='-' class='qtyminus minus btn' field='quantity'>-</button>
            <input type='number' name="stock" id="stock" value="{{$pd->stock}}" style="width:50px;text-align: center;border: 0" class='qty' min="0">
            <button type='button' value='+' class='qtyplus plus btn' field='quantity'>+</button>
       
        </div>
            
        @endforeach

        <button type="submit" class="btn" id="edit-btn" style="display: flex;margin: auto;padding: 10px 40px 10px 40px;margin-top: 20px">Edit</button>
                
    </form>

@endsection
        
@section('javascript')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection

