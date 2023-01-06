@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection


@section('content')

    {{-- Seller --}}

    @if(Auth::user()->role == 'Seller')

   
    <form action="/editProfile" method="POST" id="account-form" enctype="multipart/form-data">
        @csrf
        @foreach ($data as $dt)

        <input type="hidden" name="imageOld" value="{{$dt->image}}">

        <div class="seller-greet">
            <img src="{{Storage::url($dt->image)}}" alt="Image" id="seller-img">
            <div class="seller-profile">
                <h1 class="seller-name">{{$dt->name}}</h1>
                {{-- <button type="submit" class="btn" id="upload-btn">Upload Image</button> --}}
                <input id="image" type="file" accept=".png, .jpeg, .jpg" class="form-control" name="image" style="border: none;padding-left: 0">
            </div>
        </div>

             <div class="mb-3 input">

                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="example@gmail.com" value="{{$dt->email}}" required>
    
            </div>

            <div class="mb-3 input">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Min 8 characters" value="{{$dt->password}}" required>
            </div>

            <div class="mb-3 input">
                <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                <input type="number" name="phonenumber" class="form-control" id="exampleFormControlInput1" value="{{$dt->phone}}" required>
            </div>
        @endforeach
            
        
        <button type="submit" class="btn" id="save-btn">Save</button>
    </form>

    <form action="" id="logout-form">
        <button type="submit" class="btn" id="logout-btn">Logout</button>
    </form>

    @else
    {{-- Buyer --}}
        <h1 class="buyer-greet">Hi Username,</h1>

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

    @endif
@endsection