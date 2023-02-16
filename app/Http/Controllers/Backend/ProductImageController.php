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
        return view('backend.images.index' , compact('images', 'product'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    { $images = $product->images;
        return view('backend.images.create', compact('images', 'product'));
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
        $productImage->seq = $request->seq;
        $productImage->active = $request->active ?? 1;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('data'), $filename);
        }
        $productImage->url = $filename;
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
    public function edit(Product $product, ProductImage $productImage)
    {
        return view("backend.images.edit", ["product"=>$product, "image"=>$productImage] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductImage $productImage, Request $request)
    {
        $productImage = ProductImage::find($productImage->id);
        $productImage->product_id = $request->product_id;
        $productImage->alt = $request->alt;
        $productImage->alt	 = $request->alt;
        $productImage->seq = $request->seq;
        $productImage->active = $request->active ?? 1;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('data'), $filename);
        }
        $productImage->url = $filename;
        $productImage->save();
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
