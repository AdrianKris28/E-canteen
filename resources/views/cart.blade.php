@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    <form class="cart-group">
        <h6>Outlet Name 1</h6>
        <table class="table cart-table table-borderless">
            <tr>
                <td>
                    <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" alt="Gambar">
                </td>
                <td class="cart-detail">
                    <p class="food-name">Food Name</p>
                    <p class="food-price">Price</p>     
                </td>
                <td class="cart-qty">
                    <button type='button' value='-' class='qtyminus minus btn' field='quantity'>-</button>
                    <input type='number' name='quantity' value='1' class='qty' min="0">
                    <button type='button' value='+' class='qtyplus plus btn' field='quantity'>+</button>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" alt="Gambar">
                </td>
                <td class="cart-detail">
                    <p class="food-name">Food Name</p>
                    <p class="food-price">Price</p>     
                </td>
                <td class="cart-qty">
                    <button type='button' value='-' class='qtyminus minus btn' field='quantity'>-</button>
                    <input type='number' name='quantity' value='1' class='qty' min="0">
                    <button type='button' value='+' class='qtyplus plus btn' field='quantity'>+</button>
                </td>
            </tr>
            <tr class="cart-total">
                <td colspan="2">
                    Total
                </td>
                <td>Rp xxx.xxx</td>
            </tr>
            <tr>
                <td colspan="2">
                    
                </td>
                <td>
                    <button class="btn checkout-btn">Checkout</button>
                </td>
            </tr>
        </table>
        <hr>
    </form>

    <form class="cart-group">
        <h6>Outlet Name 1</h6>
        <table class="table cart-table table-borderless">
            <tr>
                <td>
                    <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" alt="Gambar">
                </td>
                <td class="cart-detail">
                    <p class="food-name">Food Name</p>
                    <p class="food-price">Price</p>     
                </td>
                <td class="cart-qty">
                    <button type='button' value='-' class='qtyminus minus btn' field='quantity'>-</button>
                    <input type='number' name='quantity' value='1' class='qty' min="0">
                    <button type='button' value='+' class='qtyplus plus btn' field='quantity'>+</button>
                </td>
            </tr>
            <tr class="cart-total">
                <td colspan="2">
                    Total
                </td>
                <td>Rp xxx.xxx</td>
            </tr>
            <tr>
                <td colspan="2">
                    
                </td>
                <td>
                    <button class="btn checkout-btn">Checkout</button>
                </td>
            </tr>
        </table>
        <hr>
    </form> 

@endsection

@section('javascript')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection