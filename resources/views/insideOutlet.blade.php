@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/inside-outlet.css') }}">
@endsection

@section('content')
    <div class="container">
        
 
        <a href="/insideOutlet/{{$id}}"> <h2 style="text-align: center;color: black">{{$namaOutlet}}</h2></a>
    

        <div class="row justify-content-center">
            <form action="/searchProductOutlet" method="get" style="margin-top: 20px; width:100%" class="search">
               
                <input type="hidden" name="outletId" value="{{$id}}">
                    
                <table>
                    <td>
                        <input type="text" class="form-control search-input" placeholder="Search..." name="query">
                    </td>

                    <td>
                    <button type="submit" class="btn btn-success  search-btn" >
                        Search
                    </button>
                    </td>
                
                </table>
            </form>

                {{-- <div class="outletContainer" style="display: grid; grid-template-columns: repeat(1, 1fr);margin-top: 20px"> --}}

                @php
                    $totalPrice = 0;
                @endphp

                <table class="table menu-card" style="width: 377px;margin-top: 20px">

                    @forelse ($product as $pd)
                    
                        <tr class="clickable" onclick="window.location='/menuDetailBuyer/{{$pd->id}}'">
                            <td>
                                    <img src="{{ Storage::url($pd->image) }}" style="width: 80.91px;height: 80.91px;border-radius: 10px" alt="Gambar" class="product-img">
                            </td>
                            <td>
                                <span class="menu-name">
                                    {{$pd->name}} <br>
                                </span>
                                <span class="menu-price">
                                    Rp. {{$pd->price}}
                                </span>
                            </td>
                            <td class="menu-stock">
                                <span>Stock: <br></span>
                                 {{$pd->stock}} pcs
                            </td>

                        </tr> 
                    
                    @php
                        // $totalPrice += $pd->price * $pd->qty;
                        // $totalPrice += $totalHarga
                    @endphp

                    @empty
                    <td id="datanotfound" style="text-align: center">There is no product yet</td>
                    @endforelse

                </table>

                    @php
                        // $totalPrice += $pd->price * $pd->qty;
                        $totalPrice = $totalHarga
                    @endphp
                
                <form action="/cart" method="post">
                    @csrf
                    <input type="hidden" name="transactionId" value="{{$transactionId}}" class="form-control register-input @error('transactionId') is-invalid @enderror">


                    <div style="text-align: center;color: red">
                            <b style="font-size: 13px">Make sure to input your table number correctly</b>
                    </div>

                    <div class="table-number" style="margin-top: 10px">
                        <label for="name">Table Number:</label>
                        <input type="number" name="tableNumber" value="{{$tableNumber}}" class="form-control register-input @error('tableNumber') is-invalid @enderror" style="width: 70px;text-align: center" min="1" max="20" required>
                    </div>

                        @error('tableNumber')
                        <div style="text-align: right;color: red">
                            <b>Table number has been used</b>
                        </div>
                        @enderror
                        
                        @error('transactionId')
                                <div style="text-align: right;color: red">
                                    <b>The user must add product to cart</b>
                                </div>
                        
                        @enderror

                    <div class="checkout-container" style="margin-top: 20px">
                        <input type="hidden" name="totalPrice" value="{{$totalPrice}}" class="form-control register-input @error('totalPrice') is-invalid @enderror">
                        <p>Total: Rp {{$totalPrice}}</p>
                         
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px" id="checkout-btn">Checkout</button>
                    </div>

                    @error('totalPrice')
                        <div style="text-align: right;color: red">
                            <b>Total price must be greater than Rp. 0</b>
                        </div>
                        @enderror
                    
                        
                </form>
        
        </div>
    </div>
@endsection