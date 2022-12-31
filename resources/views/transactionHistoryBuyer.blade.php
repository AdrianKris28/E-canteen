@extends('layouts.app')

@section('content')
<div class="container">
       <h2 style="text-align: center">History</h2>
            <form action="#" method="get" style="margin-top: 20px">
                <label for="start">Start date:</label>
                <input type="date" id="start" name="start-date" class="form-control">

                <br>

                <label for="start">End date:</label>
                <input type="date" id="end" name="end-date" class="form-control">

                <br>

                <button type="submit" class="btn btn-success" >
                    Search
                </button>
        
            </form>

            <table class="table" style="width: 400px; margin-top: 20px">
            
                {{-- If user == seller --}}

                    {{-- @forelse ($data as $dt) --}} 
                        <tr>
                            <td style="padding-right: 0">
                                <p style="margin-bottom: 0">Transaction ID</p>
                                <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" style="width: 109px;height:100px;border-radius: 8px" alt="Gambar">
                            </td>
                            <td>
                                <p style="margin-top: 40px">Total Harga <br>
                                    Rp xxxxxx
                                </p>                             
                            </td>
                            <td>
                                <p>Transaction Date</p>
                                <p>Transaction Status</p>
                                <a href="/transactionHistoryDetailBuyer" class="btn btn-primary">View</a>
                            </td>
                        </tr> 
                    {{-- @empty
                    <td id="datanotfound" colspan="8">No Book Has Been Added</td>
                    @endforelse --}}

            
            </table>

</div>
@endsection

