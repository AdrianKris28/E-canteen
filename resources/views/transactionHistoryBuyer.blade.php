@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/transaction-history.css') }}">
@endsection

@section('content')
<div class="container">
       <a href="/transactionHistoryBuyer"><h2 style="text-align: center;color: black">History</h2></a>
            <form action="/searchHistory" method="get" style="margin-top: 20px">
                <label for="start">Start date:</label>
                <input type="date" id="start" name="startdate" class="form-control" required>

                <br>

                <label for="start">End date:</label>
                <input type="date" id="end" name="enddate" class="form-control" required>

                <br>

                <button type="submit" class="btn btn-success" >
                    Search
                </button>
        
            </form>

            <table class="table" style="width: 400px; margin-top: 20px">
    
                @if(Auth::user()->role == 'Buyer')

                    @forelse ($data as $dt) 
                        <tr>
                            <td style="padding-right: 0">
                                <p class="transaction-id">Transaction Id {{$dt->id}}</p>
                                <img src="{{Storage::url($dt->image)}}" style="width: 75px; height: 75px; border-radius: 10px" alt="Gambar" >
                            </td>
                            <td>
                                <p style="margin-top: 40px" class="transaction-price">
                                    Total Harga <br>
                                    Rp @convert($dt->totalHarga)
                                </p>                             
                            </td>
                            <td>
                                <p class="transaction-date">{{$dt->transactionDate}}</p>
                                @if($dt->flag == 1)
                                    <p class="transaction-status" style="color: red">Waiting</p>
                                @elseif($dt->flag == 2)
                                    <p class="transaction-status" style="color: #1400FF">Accepted</p>
                                @elseif($dt->flag == 3)
                                    <p class="transaction-status" style="color: #40FF21">Finished</p>
                                @endif
                                <a href="/transactionHistoryDetailBuyer/{{$dt->id}}" class="btn btn-primary">View</a>
                            </td>
                        </tr> 
                    @empty
                    <tr>
                        <td id="datanotfound" style="text-align: center">No Transaction Have Occurred</td>
                    </tr>
                    @endforelse

                @endif
            
            </table>

</div>
@endsection

