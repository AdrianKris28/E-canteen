@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>E-Canteen</h4>
@endsection --}}

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/home-seller.css') }}">
@endsection

@section('content')


@if(Auth::check())
<div class="container">
   <div class="row justify-content-center">
        @if(Auth::user()->role == 'Buyer')
            <form action="/searchOutlet" method="get" style="margin-top: 20px" class="search">
                  <table>
                      <td>
                          <input type="text" class="form-control search-input" placeholder="Search..." name="query">
                      </td>

                      <td>
                      <button type="submit" class="btn btn-success search-btn" >
                          Search
                      </button>
                      </td>
                  
                  </table>
              </form>

              <div class="outletContainer" style="display: grid; grid-template-columns: repeat(3, 1fr);margin-top: 20px">

                  @forelse ($outlet as $ot)
                      <a href="/insideOutlet/{{$ot->id}}" style="color: black">
                          <div style="padding: 10px">
                              <img src="{{ Storage::url($ot->image) }}" alt="No Image" width="109px" height="112px" style="border-radius: 10px"><br>
                              <h5 style="padding:0; margin:10px" class="product-name"> {{$ot->name}} </h5>
                            
                          </div>
                      </a>
                  @empty
              </div>
                      <p style="margin-top: 30px"> There is no outlet yet </p>
                  @endforelse
@if(session('alert-success'))
              <script>alert("{{session('alert-success')}}")</script>
@endif

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
