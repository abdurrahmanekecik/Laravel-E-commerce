<?php

namespace Tests\Feature\Htpp\Backend;
use App\Models\ProductImage;
use Tests\TestCase;
use App\Models\Product;

class ProductImageControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page()
    {
        $response = $this->get('/products/1/images');

        $response->assertStatus(200);
    }
    public function test_index_goes_to_correct_view(){

        $response = $this->get('/products/1/images');
        $response->assertViewIs("backend.images.index");
    }

    public function test_images_create_form_page_status(){

        $response = $this->get('/products/1/images/create');
        $response->assertStatus(200);


    }




    public function test_images_create_goes_to_correct_view(){

        $response = $this->get('/products/1/images/create/');
        $response->assertViewIs("backend.images.create");
    }


    public function test_products_new_resource_is_create(){
        $image = ProductImage::factory()->make();
        $request = $image->toArray();
        $response =  $this->post("/products/1/images" , $request);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/products/");


    }

    public function test_products_existing_images_is_updated()
    {
        $images = ProductImage::all()->last();
        $images->city ="UPDATEDCİTY " . $images->city;
        $images->disctrict = "disctrict " . $images->disctrict;
        $request = $images->toArray();
        $response = $this->put("/products/1/images/" . $images->id, $request);
        $response->assertRedirect("/products/");
    }





    public function test_images_latest_images_is_deleted(){
        $image = ProductImage::all()->last();
        $id = $image->id;
        $response = $this->delete("/products/1/images/" . $id);
        $response->assertRedirect("/products/");

    }
















}
