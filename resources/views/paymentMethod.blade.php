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
            <select class="form-select" aria-label="Default select example" name="orderType" required>
                {{-- <option selected>Open this select menu</option> --}}
                <option id="order-type-option" value="Dine In" selected>Dine In</option>
                <option class="order-type-option" value="Take Away">Take Away</option>
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

    <button id="pay-button">Pay!</button>
@endsection

@section('javascript')
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });
    </script>
@endsection