@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>E-Canteen</h4>
@endsection --}}

@section('css')
<link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')


@if(Auth::check())
<div class="container">
  
  @if(Auth::user()->role == 'Buyer')
      <form action="/searchOutlet" method="get" style="margin-top: 20px">
            <table>
                <td>
                    <input type="text" class="form-control" placeholder="Search..." name="query">
                </td>

                <td>
                <button type="submit" class="btn btn-success" >
                    Search
                </button>
                </td>
            
            </table>
        </form>
    
    <div class="cardgroup row col">
      
        <div class="card" style="width: 100px;">
            <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="card-title">Kantin 1</h6>
            </div>
        </div>
        <div class="card" style="width: 100px;">
            <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="card-title">Kantin 2</h6>
            </div>
        </div>
        <div class="card" style="width: 100px;">
            <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="card-title">Kantin 3</h6>
            </div>
        </div>
        <div class="card" style="width: 100px;">
            <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" class="card-img-top" alt="...">
            <div class="card-body">
              <h6 class="card-title">Kantin 4</h6>
            </div>
        </div>
      </div>

   </div>
    @else
      
    {{-- Ini Menu Seller --}}

    <table class="table" style="text-align: center">
      <tr>
        <td><a href="/menuSeller">Menu</a></td>
      
      <td><a href="/incoming-order">Incoming Order</a></td>
      </tr>

       <tr>
        <td><a href="/salesSeller">Sales</a></td>
      
        <td><a href="/transactionHistorySeller">History</a></td>
      </tr>
      
    <tr>
      <td><a href="/account">Account</a></td>
    </tr>
    </table>
    @endif


</div>
@endif

@endsection
