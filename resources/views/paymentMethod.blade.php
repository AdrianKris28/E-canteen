@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection


@section('content')
    <form action="/payment" id="payment-method-form" method="POST">
        @csrf

        <input type="hidden" name="transactionId" value="{{$transactionId}}">
        
        <div class="order-type-group">
            <p>Dine In / Take Away</p>
            <select class="form-select" aria-label="Default select example">
                {{-- <option selected>Open this select menu</option> --}}
                <option id="order-type-option" value="1" selected>Dine In</option>
                <option class="order-type-option" value="2">Take Away</option>
              </select>
        </div>
    
        <div class="payment-method-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Default radio
                </label>
                <img src="" alt="">
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Default checked radio
                </label>
                <img src="" alt="">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Default checked radio
                </label>
                <img src="" alt="">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Default checked radio
                </label>
                <img src="" alt="">
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Default checked radio
                </label>
                <img src="" alt="">
            </div>
        </div>
        
        <button class="btn" type="submit" id="payment-btn">Select Payment Method</button>
        
    </form>
@endsection