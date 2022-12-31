@extends('layouts.app')

@section('content')
<div class="container">
       <h2 style="text-align: center">Sales</h2>
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


            <table class="table" style="width: 300px;margin-top: 20px">

                    {{-- @forelse ($data as $dt) --}} 
                        <tr>
                            <td>
                                <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" style="width: 109px;height:100px;border-radius: 8px" alt="Gambar">
                                <h5 style="margin-top: 5px">Product Name</h5>
                            </td>
                            <td>
                                <h3> 
                                    Terjual: <br>
                                    xxx
                                </h3>                      
                            </td>
                        </tr> 
                    {{-- @empty
                    <td id="datanotfound" colspan="8">No Book Has Been Added</td>
                    @endforelse --}}
            
            </table>

            <h3 style="text-align: center">Total Sales: Rp xxxxxx</h3>

</div>
@endsection

