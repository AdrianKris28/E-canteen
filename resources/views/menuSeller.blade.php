@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>Outlet Name</h4>
@endsection --}}

@section('content')
<div class="container">

    <div class="row justify-content-center">
       <h2>Outlet Name</h2>
            <form action="#" method="get" style="margin-top: 20px">
                    <table>
                        <td>
                            <input type="text" class="form-control" placeholder="Search.." name="query">
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

                    {{-- @forelse ($data as $dt) --}}
                     
                        <tr>
                            <td ><img src="#" alt="Gambar"></td>
                            <td>Food Name <br>
                                Rp.
                            </td>
                            <td>
                                Stock x pcs
                            </td>
                            <td>
                                <a href="/menuDetailSeller" class="btn btn-primary">View</a>
                                <a href="#" class="btn btn-danger">Delete</a></td>

                        </tr> 
                    
                    {{-- @empty
                    <td id="datanotfound" colspan="8">No Book Has Been Added</td>
                    @endforelse --}}
            
        </table>
    
    </div>


</div>

@endsection
