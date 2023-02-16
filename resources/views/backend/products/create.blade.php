@extends('backend.app')
@section('tittle', 'Product Create')
@section('content')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Panel</h1>
        </div>
        <h2>Product Add</h2>



        <form action="{{url("/products")}}" method="POST" autocomplete="off" novalidate>
                @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Name" placeholder="Name Enter" field="name"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            <option value="-1">Seçiniz</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach


                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Old Price" placeholder="Old Price Enter" field="old_price"/>
                </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Price" placeholder="Price Enter" field="price"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-textarea label="Lead" placeholder="Lead Enter" field="lead"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-textarea label="Description" placeholder="Description Enter" field="description"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <x-input label="Slug" placeholder="Slug Enter" field="slug"/>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <x-checkbox label="Active" field="is_active"/>
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

