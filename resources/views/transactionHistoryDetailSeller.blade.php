@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>Detail Transaction</h4>
@endsection --}}

@section('content')
<div class="container" style="border: solid black 1px;border-radius: 7px">
       <h2 style="text-align: center">Detail Transaction</h2>

       <div style="max-width: 350px;margin: auto;margin-top: 20px">

            <div style="display: flex;justify-content: space-between">
                 <p>Transaction ID</p>
                 <p>Transaction Date</p>
            </div>
       
            <p>User ID</p>
            <table class="table">
                    
                    {{-- @forelse ($data as $dt) --}} 
                        <tr>
                            <td>
                                <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" style="width: 75px;height:66px;border-radius: 8px" alt="Gambar">
                            </td>
                            <td>
                                <p>Item Name <br>
                                    Rp xxxxxx
                                </p>                             
                            </td>
                            <td>
                                <p>Quantity</p>
                            </td>
                        </tr> 
                    {{-- @empty
                    <td id="datanotfound" colspan="8">No Book Has Been Added</td>
                    @endforelse --}}
            
            </table>

            <div style="display: flex;justify-content: space-between">
                <p>TOTAL</p>
                <p>Rp xxxxxx</p>
            </div>

            <div style="display: flex;justify-content: space-between">
                <p>Dine In / Take Away</p>
                <p>Dine In</p>
            </div>

            <div style="display: flex;justify-content: space-between">
                <p>Payment Method</p>
                <p>GOPAY</p>
            </div>

            <div style="display: flex;justify-content: space-between">
                <p>Transaction Status</p>
                <p>PAID</p>
            </div>
        </div>
</div>
@endsection

