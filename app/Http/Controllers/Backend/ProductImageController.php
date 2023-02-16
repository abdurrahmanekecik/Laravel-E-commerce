<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)

    {
        $images = $product->images;
        return view('backend.products.index' , compact('images'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    { $images = $product->images;
        return view('backend.products.create', compact('images', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductImage $productImage, Request $request)
    {

        $productImage= new ProductImage();
        $productImage->product_id = $request->product_id;
        $productImage->alt = $request->alt;
        $productImage->alt	 = $request->alt;
        $productImage->seq = $request->seq;
        $productImage->active = $request->active ?? 1;
        $productImage->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, ProductImage $products)
    {
        return view("backend.images.edit", ["user"=>$product, "images"=>$products] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductImage $productimages, Request $request)
    {
        $product = ProductImage::find($productimages->id);
        $product->product_id = $request->product_id;
        $product->alt = $request->alt;
        $product->alt	 = $request->alt;
        $product->seq = $request->seq;
        $product->active = $request->active ?? 1;
        $product->save();
        return redirect('/products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductImage $productimages)
    {
        $products= ProductImage::find($productimages->id);
        $products->delete();
        return redirect('/products');

    }
}
