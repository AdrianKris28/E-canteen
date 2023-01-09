@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/inside-outlet.css') }}">
@endsection

@section('content')
    <div class="container">
        
        {{-- @foreach ($outlet as $ot)
        <h2 style="text-align: center">{{$ot->name}}</h2>
        @endforeach --}}

        <div class="row justify-content-center">
            <form action="/searchProduct" method="get" style="margin-top: 20px; width:100%" class="search">
                <table>
                    <td>
                        <input type="text" class="form-control search-input" placeholder="Search..." name="query">
                    </td>

                    <td>
                    <button type="submit" class="btn btn-success  search-btn" >
                        Search
                    </button>
                    </td>
                
                </table>
            </form>

                {{-- <div class="outletContainer" style="display: grid; grid-template-columns: repeat(1, 1fr);margin-top: 20px"> --}}

                @php
                    $totalPrice = 0;
                @endphp

                <table class="table menu-card" style="width: 377px;margin-top: 20px">

                    @forelse ($product as $pd)
                    
                        <tr class="clickable" onclick="window.location='/menuDetailBuyer/{{$pd->id}}'">
                            <td>
                                    <img src="{{ Storage::url($pd->image) }}" style="width: 80.91px;height: 80.91px;border-radius: 10px" alt="Gambar" class="product-img">
                            </td>
                            <td>
                                <span class="menu-name">
                                    {{$pd->name}} <br>
                                </span>
                                <span class="menu-price">
                                    Rp. {{$pd->price}}
                                </span>
                            </td>
                            <td class="menu-stock">
                                <span>Stock: <br></span>
                                 {{$pd->stock}} pcs
                            </td>
                            {{-- <td class="delete-btn"> --}}
                                {{-- <a href="/deleteMenu/{{$pd->id}}" > --}}
                                    {{-- Delete --}}
                                    {{-- <img src="{{ Storage::url("images\delete-icon.png") }}" alt="delete-icon">
                                </a> --}}
                            {{-- </td> --}}

                        </tr> 
                    
                    @php
                        // masih belum finish
                        $totalPrice += 0;
                    @endphp

                    @empty
                    <td id="datanotfound" style="text-align: center">There is no product yet</td>
                    @endforelse

                </table>


                {{-- @forelse ($product as $pd) 
                    <a href="#" style="color: black">
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr);width: 400px;margin-left: 40px">
                            <img src="{{ Storage::url($pd->image)}}" style="width: 84px;height: 84px;border-radius: 10px" alt="Img">
                            <p>{{$pd->name}} <br> Rp {{$pd->price}}</p>
                            <p style="text-align: center">{{$pd->stock}} Stock</p>
                            
                        </div>
                    </a>

                @php
                // masih belum finish
                $totalPrice += 0;
                @endphp

                @empty
                    <p style="margin-top: 30px"> There is no product yet </p>
                @endforelse
                     --}}
                
                    <div class="checkout-container">
                        <p>Total: Rp {{$totalPrice}}</p>
                        <form action="#" method="POST">
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px" id="checkout-btn">Checkout</button>
                        </form>
                    </div>
                {{-- </div> --}}
        
        </div>
    </div>
@endsection