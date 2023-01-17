@extends('layouts.app')

{{-- @section('navbarTitle')
<h4>Detail Transaction</h4>
@endsection --}}

@section('content')
<div class="container">
    <div style="border: solid black 1px;border-radius: 7px">
       <h2 style="text-align: center">Detail Transaction</h2>

        <div style="max-width: 350px;margin: auto;margin-top: 20px">

                <div style="display: flex;justify-content: space-between">
                    <p>Transaction Id {{$outlet->id}}</p>
                    <p>{{$outlet->transactionDate}}</p>
                </div>
        
            
                <table>
                
                        <tr>
                            <td> <p>{{$outlet->storeName}}</p> </td>
                        
                                <table class="table">
                                        
                                    @foreach ($product->where('transactionId', $outlet->id)->where('qty', '!=', null) as $pd)
                                            
                                        <tr>
                                            <td>
                                                <img src="{{Storage::url($pd->image)}}" style="width: 75px;height:66px;border-radius: 8px" alt="Gambar">
                                            </td>
                                            <td>
                                                <p>{{$pd->productName}} <br>
                                                    Rp &nbsp; @convert($pd->price)
                                                </p>                             
                                            </td>
                                            <td>
                                                <p>{{$pd->qty}}</p>
                                            </td>
                                        </tr> 
                                        
                                        @endforeach

                                </table>

                                {{-- <div style="display: flex;justify-content: space-between">
                                            <p>Subtotal</p>
                                            <p>Rp {{$outlet->totalHarga}}</p>
                                </div> --}}

                        </tr>       

               
                </table>

                <div style="display: flex;justify-content: space-between;margin-top: 20px">
                    <p>TOTAL</p>
                    <p>Rp &nbsp; @convert($outlet->totalHarga)</p>
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
                    @if($outlet->flag == 1)
                        <p class="transaction-status" style="color: red">Waiting</p>
                    @elseif($outlet->flag == 2)
                        <p class="transaction-status" style="color: #1400FF">Accepted</p>
                    @elseif($outlet->flag == 3)
                        <p class="transaction-status" style="color: #40FF21">Finished</p>
                    @endif
                </div>
            </div>

        </div>

        <div style="display: flex;justify-content: flex-end;margin-top: 15px">
        <a href="/transactionHistoryBuyer" class="btn btn-danger">Back</a>
        </div>
</div>
@endsection

