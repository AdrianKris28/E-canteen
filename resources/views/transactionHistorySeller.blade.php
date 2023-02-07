@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/transaction-history.css') }}">
@endsection

@section('content')
<div class="container" >
       <h2 style="text-align: center">Transaction History</h2>
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
                
                @if(Auth::user()->role == 'Seller')

                @forelse ($data as $dt)     
                    <tr>
                        
                        <td style="padding-right: 0">
                            <p class="transaction-id">Transaction ID &nbsp {{$dt->id}}</p>

                            @foreach ($image->where('id', $dt->id)->take(1) as $img)
                            <img src="{{Storage::url($img->image)}}" class="transaction-img" alt="Gambar">
                            @endforeach
                        </td>
                        <td>
                            <p style="margin-top: 40px" class="transaction-price">
                                Total Harga <br>
                                Rp &nbsp; @convert($dt->totalHarga)
                            </p>                             
                        </td>
                        <td>
                            <p class="transaction-date">{{$dt->transactionDate}}</p>
                            <a href="/transactionHistoryDetailSeller/{{$dt->id}}" class="btn btn-primary">View</a>
                        </td>
                        
                    </tr> 
                    @empty
                    <tr>
                        <td id="datanotfound" style="text-align: center">No Transaction Have Occurred Today</td>
                    </tr>
                    @endforelse
            
                @endif
            </table>
</div>
@endsection

