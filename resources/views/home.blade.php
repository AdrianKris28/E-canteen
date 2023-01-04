@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>E-Canteen</h4>
@endsection --}}

@section('css')
<link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')


{{-- @if(Auth::check()) --}}
<div class="container">
    <div class="input-group">
        <div class="form-outline">
          <input type="search" id="form1" class="form-control" />
          <label class="form-label" for="form1">Search</label>
        </div>
        <button type="button" class="btn btn-primary">
          <i class="fab fa-search"></i>
        </button>
      </div>
    
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
{{-- @endif --}}

@endsection
