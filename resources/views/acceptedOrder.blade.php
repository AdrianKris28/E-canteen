@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/accepted-order.css') }}">
@endsection


@section('content')
    <div class="order-group">
        <a href="{{route('incomingOrder')}}"><button class="btn" id="incoming-btn">Incoming</button></a>
        <a href="{{route('acceptedOrder')}}"><button class="btn" id="accepted-btn">Accepted</button></a>
    </div>

    <form action="" class="order-card">
        <div class="order-header">
            <h6>Transaction ID</h6>
            <h6>Transaction Date</h6>
        </div>

        <table class="table table-borderless" id="order-detail">
            <tr class="table-head">
                <td>Qty</td>
                <td>Product Name</td>
                <td>Price</td>
            </tr>

            <tr>
                <td>x1</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td>x2</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td>x1</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr class="table-total">
                <td colspan="2">Total</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td colspan="2">Dine In / Take Away</td>
                <td>Take Away</td>
            </tr>
        </table>

        <button class="btn" id="finish-btn">FINISH DELIVERY</button>
    </form>

    <form action="" class="order-card">
        <div class="order-header">
            <h6>Transaction ID</h6>
            <h6>Transaction Date</h6>
        </div>

        <table class="table table-borderless" id="order-detail">
            <tr class="table-head">
                <td>Qty</td>
                <td>Product Name</td>
                <td>Price</td>
            </tr>

            <tr>
                <td>x1</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td>x2</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td>x1</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr class="table-total">
                <td colspan="2">Total</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td colspan="2">Dine In / Take Away</td>
                <td>Take Away</td>
            </tr>
        </table>

        <button class="btn" id="finish-btn">FINISH DELIVERY</button>
    </form>

    <form action="" class="order-card">
        <div class="order-header">
            <h6>Transaction ID</h6>
            <h6>Transaction Date</h6>
        </div>

        <table class="table table-borderless" id="order-detail">
            <tr class="table-head">
                <td>Qty</td>
                <td>Product Name</td>
                <td>Price</td>
            </tr>

            <tr>
                <td>x1</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td>x2</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td>x1</td>
                <td>Product Name</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr class="table-total">
                <td colspan="2">Total</td>
                <td>Rp xxxxx</td>
            </tr>

            <tr>
                <td colspan="2">Dine In / Take Away</td>
                <td>Take Away</td>
            </tr>
        </table>

        <button class="btn" id="finish-btn">FINISH DELIVERY</button>
    </form>
    

@endsection