@extends('backend.app')
@section('tittle', 'Address Edit')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Product Image Edit</h2>



        <form method="POST" action="{{url("/products/$product->id/images/$image->id")}}"enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            @error("product_id")
            <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>İmage</label>
                        <input placeholder="İmage Upload" type="file" class="form-control" name="url" value="url"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Description" placeholder="Description Enter" field="alt" value="alt"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-input label="Sequence No" placeholder="Sequence No Enter" field="seq" value="seq"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-checkbox label="Active" field="active" checked="{{$image->active == 1 }}" value="{{$image->id}}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success"> Save</button>

                        </div>
                    </div>
                </div>


            </form>






@endsection
@section('js')
@endsection
@section('css')
@endsection

