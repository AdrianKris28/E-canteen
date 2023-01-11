@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')

<h2 style="text-align: center">Cart</h2>

@forelse ($outlet as $ot)
    <form class="cart-group" method="POST" action="/checkoutCart">
        @csrf

        <input type="hidden" name="transactionId" value="{{$ot->transactionId}}">
            <h6>{{$ot->name}}</h6>

            <table class="table cart-table table-borderless">

                @php
                    $grandTotal = 0;
                @endphp
                
                @php
                $counter = 0;    
                @endphp

                @foreach ($product->where('sellerId', '=', $ot->sellerId) as $pd)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($pd->image)}}" alt="Gambar">
                        </td>
                        <td class="cart-detail">
                            <p class="food-name">{{$pd->productName}}</p>
                            <p class="food-price">Rp. {{$pd->price}}</p>     
                        </td>
                        <td class="cart-qty">
                            <a href="/minusQuantity/{{$ot->transactionId}}/{{$pd->productId}}">
                                <button type='button' value='-' class='qtyminus minus btn' field='quantity'>-</button>
                            </a>

                            <input type='number' name='quantity[{{$counter}}]' value='{{$pd->qty}}' class='qty' min="0" id="qty">
                            <input type="hidden" name="productId[{{$counter}}]" value="{{$pd->productId}}">
                            <a href="plusQuantity/{{$ot->transactionId}}/{{$pd->productId}}">
                                <button type='button' value='+' class='qtyplus plus btn' field='quantity'>+</button>
                            </a>
                            
                            @php
                                $counter++;
                            @endphp
                            
                        </td>
                    </tr>
                    @php
                        $grandTotal += $pd->qty * $pd->price;
                    @endphp
                @endforeach
                <tr class="cart-total">
                    <td colspan="2">
                        Total
                    </td>
                    <td>Rp {{$grandTotal}}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        
                    </td>
                    <td>
                        <button type="submit" class="btn checkout-btn">Checkout</button>
                    </td>
                </tr>
            </table>

            <hr>
        </form>
        @empty
            <h5 style="text-align: center;margin-top: 30px;color: red"> <b>There is no product to checkout</b></h2>
        @endforelse


@endsection

@section('javascript')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection