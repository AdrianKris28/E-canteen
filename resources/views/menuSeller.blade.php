@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>Outlet Name</h4>
@endsection --}}

@section('css')
    <link rel="stylesheet" href="{{ asset('css/menu-seller.css') }}">
@endsection

@section('content')
<div class="container">

    <a href="/menuSeller"><h2 style="color: black;text-align: center"> {{Auth::user()->name}}</h2></a>
    
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

        <a href="/addNewProductSeller" style="margin-left: 210px" class="btn btn-primary" id="new-product-btn">Add New Product</a>

        <table class="table menu-card" style="width: 377px;margin-top: 20px">

                    @forelse ($product as $pd)
                     
                        <tr class="clickable" onclick="window.location='/menuDetailSeller/{{$pd->id}}'">
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
                               {{$pd->stock}} pcs
                            </td>
                            <td class="delete-btn">
                                <a href="/deleteMenu/{{$pd->id}}" >
                                    {{-- Delete --}}
                                    <img src="{{ Storage::url("images\delete-icon.png") }}" alt="delete-icon">
                                </a>
                            </td>

                        </tr> 
                    
                    @empty
                    <td id="datanotfound" style="text-align: center">No Product Has Been Added</td>
                    @endforelse
            
        </table>
    
    </div>

</div>

@endsection
