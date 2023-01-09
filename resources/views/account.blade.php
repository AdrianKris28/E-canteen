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

    @else
    {{-- Buyer --}}
    
    <form action="/editProfile" id="account-form" method="POST">
        @csrf
        @foreach ($data as $dt)
            
            <h1 class="buyer-greet">Hi {{$dt->name}},</h1>
            <div class="mb-3 input">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="{{$dt->email}}" required>
            </div>

            <div class="mb-3 input">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Min 8 characters" value="{{$dt->password}}" required>
            </div>

            <div class="mb-3 input">
                <label for="exampleFormControlTextarea1" class="form-label">Phone Number</label>
                <input type="number" name="phonenumber" class="form-control" id="exampleFormControlInput1" placeholder="08xxxxxxxxxx" value="{{$dt->phone}}" required>
            </div>
        @endforeach

            <button type="submit" class="btn" id="save-btn">Save</button>
        </form>

    @endif
    
    <form action="" id="logout-form">
        <button type="submit" class="btn" id="logout-btn">Logout</button>
    </form>
@endsection