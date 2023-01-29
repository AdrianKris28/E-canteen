@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add New Product</div>

                <div class="card-body">
                    <form method="POST" action="/addProduct" enctype="multipart/form-data" >
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-6 col-form-label text-md-left">Name:</label>

                            <div class="col-md-12">
                                <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-6 col-form-label text-md-left">Description:</label>

                            <div class="col-md-12">
                                <textarea id="description" name="description" cols="40" rows="5" class="form-control @error('description') is-invalid @enderror" required autocomplete="name" autofocus></textarea>
                                
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

   
                        <div class="row mb-3">
                            <label for="price" class="col-md-6 col-form-label text-md-left">Price:</label>

                            <div class="col-md-12">
                                <input id="price" type="price" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stock" class="col-md-6 col-form-label text-md-left">Stock:</label>

                            <div class="col-md-12">
                                <input id="stock" type="stock" class="form-control @error('stock') is-invalid @enderror" name="stock" required autocomplete="stock">

                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label text-md-left">Image:</label>

                            <div class="col-md-9">
                                <input id="image" type="file" accept=".png, .jpeg, .jpg" class="form-control @error('image') is-invalid @enderror" name="image" required autocomplete="image" style="border: none">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
