@extends('layouts.app')

@section('content')
<div class="container">
       <h2 style="text-align: center">Sales</h2>

            <form action="/searchSales" method="get" style="margin-top: 20px">
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


            <table class="table" style="width: 300px;margin-top: 20px">

                    @forelse ($product as $pd) 
                        <tr>
                            <td>
                                <img src="{{ Storage::url($pd->image)}}" style="width: 109px;height:100px;border-radius: 8px" alt="Gambar">
                                <h5 style="margin-top: 5px">{{$pd->name}}</h5>
                            </td>
                            <td>
                                <h3> 
                                    Terjual: <br>
                                    {{$pd->productSales}}
                                </h3>                      
                            </td>
                        </tr> 
                    @empty
                   
                        <p style="text-align: center; margin-top: 20px">There is no sales today</p>
                   
                    @endforelse
            
            </table>

            <h3 style="text-align: center">Total Sales: Rp {{$totalSales}}</h3>

</div>
@endsection

