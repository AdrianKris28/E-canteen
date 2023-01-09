@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>E-Canteen</h4>
@endsection --}}

@section('css')
<link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/home-seller.css') }}">
@endsection

@section('content')


@if(Auth::check())
<div class="container">
   <div class="row justify-content-center">
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
          
          {{-- <div class="cardgroup row col">
            
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
            </div> --}}

              <div class="outletContainer" style="display: grid; grid-template-columns: repeat(3, 1fr);margin-top: 20px">

                  @forelse ($outlet as $ot)
                      <a href="/insideOutlet/{{$ot->id}}" style="color: black">
                          <div style="padding: 10px">
                              <img src="{{ Storage::url($ot->image) }}" alt="No Image" width="100px" height="100px" style="border-radius: 10px"><br>
                              <h5 style="padding:0; margin:10px"> {{$ot->name}} </h5>
                            
                          </div>
                      </a>
                  @empty
              </div>
                      <p style="margin-top: 30px"> There is no outlet yet </p>
                  @endforelse


       
        @else
          
        {{-- Ini Menu Seller --}}

        <table class="table home-seller" style="text-align: center">
          <tr>
            <td class="col-sd-1 home-seller-btn"><a href="/menuSeller">Menu</a></td>
            <td class="col-sd-1"></td>
            <td class="col-sd-1 home-seller-btn"><a href="/incomingOrder">Incoming <br> Order</a></td>
          </tr>

          <tr class="white"></tr>

          <tr>
            <td class="col-sd-1 home-seller-btn"><a href="/salesSeller">Sales</a></td>
            <td class="col-sd-1"></td>
            <td class="col-sd-1 home-seller-btn"><a href="/transactionHistorySeller">History</a></td>
          </tr>
          
          <tr class="white"></tr>

          <tr>
            <td class="col-sd-1 home-seller-btn"><a href="/account">Account</a></td>
            <td class="col-sd-1"></td>
            <td class="col-sd-1"></td>
          </tr>
        </table>

        
        @endif

    </div>
  </div>
@endif

@endsection
