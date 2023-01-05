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
        
     <form action="/editMenu" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach ($product as $pd)

        <input type="hidden" name="productId" value="{{$pd->id}}">
        <input type="hidden" name="imageOld" value="{{$pd->image}}">

        <img src="{{ Storage::url($pd->image)}}" style="width: 100%;height: 300px" alt="Gambar">
            
        <div style="margin-top: 30px">
            <div>
                <h2 style="margin-left: 9px"><input type="text" name="name" style="border: 0" value="{{$pd->name}}"></h2>
                <h2 style="margin-left: 10px">Rp. <input type="number" name="price" style="border: 0" value="{{$pd->price}}" min="1"></h2>
            </div>
           
            <textarea name="description" id="description" cols="30" rows="5" style="margin-left: 9px;border: 0" value="{{$pd->description}}">{{$pd->description}}</textarea>
          
            <input id="image" type="file" accept=".png, .jpeg, .jpg" class="form-control @error('image') is-invalid @enderror" name="image" style="border: none">
             
        </div>


        
        <div style="text-align: center;margin-top: 100px">
            <label for="stock"><h5>Quantity:</h5></label>
            <input type="number" name="stock" id="stock" value="{{$pd->stock}}" style="width:50px;text-align: center;border: 0" min="1">
        </div>

      
            
        @endforeach

        <button type="submit" class="btn btn-primary" style="display: flex;margin: auto;padding: 10px 40px 10px 40px;margin-top: 20px">Edit</button>
                
        </form>
    

</body>
</html>

