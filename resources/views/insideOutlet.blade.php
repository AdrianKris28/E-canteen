@extends('layouts.app')

@section('content')
    <div class="container">
        
        {{-- @foreach ($outlet as $ot)
        <h2 style="text-align: center">{{$ot->name}}</h2>
        @endforeach --}}

        <div class="row justify-content-center">
                <form action="/searchProductOutlet" method="get" style="margin-top: 20px">

                        <table>
                            <td>
                                <input type="text" class="form-control" placeholder="Search..." name="query">
                            </td>

                            <td>
                            <button type="submit" class="btn btn-success" >
                                Search
                            </button>
                            </td>
                        
                        </table>
                </form>
            

                <div class="outletContainer" style="display: grid; grid-template-columns: repeat(1, 1fr);margin-top: 20px">

                @php
                    $totalPrice = 0;
                @endphp

                @forelse ($product as $pd) 
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
                    
                
                    <div style="display: flex;justify-content: space-evenly;align-items: center;margin: auto;margin-top: 40px;border: 1px black solid;border-radius: 10px;width: 349px;padding: 10px 0 10px 0">
                        <b>Total: Rp {{$totalPrice}}</b>
                        <form action="#" method="POST">
                            <button type="submit" class="btn btn-danger" style="border-radius: 10px">Checkout</button>
                        </form>
                    </div>
                </div>
        
        </div>
    </div>
@endsection