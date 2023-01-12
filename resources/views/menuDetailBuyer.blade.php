<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
        
     <form action="/addToCart" method="post">
        @csrf
        @foreach ($product as $pd)
        <input type="hidden" name="productId" value="{{$pd->id}}">
        <input type="hidden" name="outletId" value="{{$pd->sellerId}}">

        <img src="{{ Storage::url($pd->image)}}" style="width: 100%;height: 300px" alt="Gambar">
            
        <div style="margin-top: 30px">
            <div>
                <h2 style="margin-left: 9px">{{$pd->name}}</h2>
                <h2 style="margin-left: 10px">Rp. {{$pd->price}}</h2>
            </div>
            <p style="margin-left: 10px">{{$pd->description}}</p>
        </div>
        
        <div style="text-align: center;margin-top: 100px">
            <label for="quantity"><h5>Quantity:</h5></label>
                <input type="number" name="quantity" id="quantity" value="{{$qty}}" style="width:50px;text-align: center;border: 0" min="1" max="{{$stock}}">

        </div>
            
        @endforeach

        <button type="submit" class="btn btn-primary" style="display: flex;margin: auto;padding: 10px 40px 10px 40px;margin-top: 20px">Add to Cart</button>
                
        </form>
    

</body>
</html>

