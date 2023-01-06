@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>Outlet Name</h4>
@endsection --}}

@section('content')
<div class="container">

    <a href="/menuSeller"><h2 style="color: black;text-align: center"> {{Auth::user()->name}}</h2></a>
    
    <div class="row justify-content-center">
      
            <form action="/searchProduct" method="get" style="margin-top: 20px">

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

        <a href="/addNewProductSeller" style="margin-left: 130px;margin-top: 20px" class="btn btn-primary">Add New Product</a>

        <table class="table" style="width: 300px;margin-top: 20px">

                    @forelse ($product as $pd)
                     
                        <tr>
                            <td ><img src="{{ Storage::url($pd->image) }}" style="width: 80.91px;height: 80.91px;border-radius: 10px" alt="Gambar"></td>
                            <td>{{$pd->name}} <br>
                                Rp. {{$pd->price}}
                            </td>
                            <td>
                               {{$pd->stock}} pcs
                            </td>
                            <td>
                                <a href="/menuDetailSeller/{{$pd->id}}" class="btn btn-primary">View</a>
                                <a href="/deleteMenu/{{$pd->id}}" class="btn btn-danger">Delete</a></td>

                        </tr> 
                    
                    @empty
                    <td id="datanotfound" style="text-align: center">No Product Has Been Added</td>
                    @endforelse
            
        </table>
    
    </div>

</div>

@endsection
