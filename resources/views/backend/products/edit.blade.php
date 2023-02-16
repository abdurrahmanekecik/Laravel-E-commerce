@extends('backend.app')
@section('tittle', 'Product Edit')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Product Edit</h2>



        <form method="POST" action="{{url("/products/$product->id")}}">
            @csrf
            @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-input label="Name" placeholder="Name Enter" field="name"  value="{{ $product->name }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)

                                    <option value="{{$category->id}}" {{$product->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-input label="Old Price" placeholder="Old Price Enter" field="old_price" value="{{ $product->old_price }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-input label="Price" placeholder="Price Enter" field="price" value="{{ $product->price }}"/>
                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <x-textarea label="Lead" placeholder="Lead Enter" field="lead" value="{{ $product->lead }}"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <x-textarea label="Description" placeholder="Description Enter" field="description" value="{{ $product->description }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-input label="Slug" placeholder="Slug Enter" field="slug" value="{{ $product->slug }}"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">

                            <x-checkbox label="Active" field="is_active"  value="{{ $product->is_active }}"/>

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

