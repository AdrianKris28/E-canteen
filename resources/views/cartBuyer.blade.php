@extends('layouts.app')


@section('content')
<div class="container">
    {{-- kalo banyak putlet berarti di forelse lagi disini --}}
    <h3>Outlet 1</h3>
    <table class="table" style="width: 400px; margin-top: 20px">
        {{-- If user == seller --}}
            {{-- @forelse ($data as $dt) --}} 
                <tr>
                    <td style="padding-right: 0">
                        <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" style="width: 109px;height:100px;border-radius: 8px" alt="Gambar">
                    </td>
                    <td>
                        <p style="margin-top: 25px">Total Harga <br>
                            Rp xxxxxx
                        </p>                             
                    </td>
                    <td>
                        <input type="number" id="quantity" name="quantity" min="1" max="5" style="margin-top: 30px"><br><br>
                    </td>
                </tr>
                {{-- @empty
                    <td id="datanotfound" colspan="8">No Book Has Been Added</td>
                    @endforelse --}}
    </table>
    <h5>Total: Rp xxxxxx</h5>
    <button>Checkout</button>
    <h3>Outlet 1</h3>
    <table class="table" style="width: 400px; margin-top: 20px">
        {{-- If user == seller --}}
            {{-- @forelse ($data as $dt) --}} 
                <tr>
                    <td style="padding-right: 0">
                        <img src="https://img.freepik.com/free-photo/chicken-wings-barbecue-sweetly-sour-sauce-picnic-summer-menu-tasty-food-top-view-flat-lay_2829-6471.jpg?w=2000" style="width: 109px;height:100px;border-radius: 8px" alt="Gambar">
                    </td>
                    <td>
                        <p style="margin-top: 25px">Total Harga <br>
                            Rp xxxxxx
                        </p>                             
                    </td>
                    <td>
                        <input type="number" id="quantity" name="quantity" min="1" max="5" style="margin-top: 30px"><br><br>
                    </td>
                </tr>
                {{-- @empty
                    <td id="datanotfound" colspan="8">No Book Has Been Added</td>
                    @endforelse --}}
    </table>
    <h5>Total: Rp xxxxxx</h5>
    <button>Checkout</button>
</div>

@endsection