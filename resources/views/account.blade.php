@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection


@section('content')
    
    {{-- Buyer --}}
    {{-- <h1 class="buyer-greet">Hi Username,</h1>

    <form action="" id="account-form">
        <div class="mb-3 input">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
        </div>

        <div class="mb-3 input">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Min 8 characters" required>
        </div>

        <div class="mb-3 input">
            <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="08xxxxxxxxxx" required>
        </div>

        <button type="submit" class="btn" id="save-btn">Save</button>
    </form> --}}

    {{-- Seller --}}
    <div class="seller-greet">
        <img src="" alt="#" id="seller-img">
        <div class="seller-profile">
            <h1 class="seller-name">Outlet Name</h1>
            <button type="submit" class="btn" id="upload-btn">Upload Image</button>
        </div>
    </div>

    <form action="" id="account-form">
        <div class="mb-3 input">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
        </div>

        <div class="mb-3 input">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Min 8 characters" required>
        </div>

        <div class="mb-3 input">
            <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="08xxxxxxxxxx" required>
        </div>

        <button type="submit" class="btn" id="save-btn">Save</button>
    </form>

    <form action="" id="logout-form">
        <button type="submit" class="btn" id="logout-btn">Logout</button>
    </form>
@endsection