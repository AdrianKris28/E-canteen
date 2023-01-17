@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/incoming-order.css') }}">
@endsection


@section('content')
    <div class="order-group">
        <a href="{{route('incomingOrder')}}"><button class="btn" id="incoming-btn">Incoming</button></a>
        <a href="{{route('acceptedOrder')}}"><button class="btn" id="accepted-btn">Accepted</button></a>
    </div>

    @if(Auth::user()->role == 'Seller')

    @forelse ($data as $dt) 
        <form action="/acceptOrder" class="order-card" method="POST">
            @csrf
            <input type="hidden" name="transactionId" value="{{$dt->id}}">
            <div class="order-header">
                <h6>Transaction ID &nbsp {{$dt->id}}</h6>
                <h6>{{$dt->updated_at}}</h6>
            </div>

            <div class="order-header">
                <h6>Buyer ID &nbsp {{$dt->buyerId}}</h6>
                <h6>Table Number: &nbsp {{$dt->tableNumber}}</h6>
            </div>

            <table class="table table-borderless" id="order-detail">
                <tr class="table-head">
                    <td>Qty</td>
                    <td>Product Name</td>
                    <td>Price</td>
                </tr>

                @forelse ($countData->where('transactionId', '=', $dt->id) as $count)
                {{-- $product->where('sellerId', '=', $ot->sellerId) as $pd)  --}}
                    <tr>
                        <td>x{{$count->qty}}</td>
                        <td>{{$count->name}}</td>
                        <td>Rp @convert($count->price * $count->qty)</td>
                    </tr>
                @empty
                
                @endforelse 

                <tr class="table-total">
                    <td colspan="2">Total</td>
                    <td>Rp &nbsp; @convert($dt->totalHarga)</td>
                </tr>

                <tr>
                    <td colspan="2">Dine In / Take Away</td>
                    <td>Take Away</td>
                </tr>
            </table>

            <button type="submit" class="btn" id="accept-btn">Accept Order</button>
        </form>
        
        @empty
        <tr>
            <td id="datanotfound" style="text-align: center">No Transaction Have Occurred</td>
        </tr>
        @endforelse

    @endif

@endsection