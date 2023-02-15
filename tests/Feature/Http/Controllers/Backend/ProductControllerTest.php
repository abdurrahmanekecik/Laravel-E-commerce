<?php

namespace Tests\Feature\Http\Controllers\Backend;
use App\Models\Product;
use Faker\Generator;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_products_index_status()
    {
        $response = $this->get('/products');
        $response->assertOk();
    }

    public function test_products_index_url_goes_to_correct_view()
    {
        $response = $this->get('/products');
        $response->assertViewIs("backend.products.index");
    }

    public function test_products_create_form_page_status()
    {
        $response = $this->get('/products/create');
        $response->assertOk();
    }

    public function test_products_create_form_goes_to_correct_view()
    {
        $response = $this->get('/products/create');
        $response->assertViewIs("backend.products.create");
    }

    public function test_products_new_resource_is_create(){
        $generator = app(Generator::class);
        $request = [

            "name" => $generator ->name,
            "category_id" => "1",
            "price" => $generator ->buildingNumber,
            "old_price" => $generator ->buildingNumber,
            "lead" => $generator ->text,
            "description" => $generator ->text,
            "slug" => $generator ->slug,
            "is_active" => $generator ->boolean,
        ];
        $response =  $this->post("/products" , $request);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/products");


    }
    public function test_products_existing_user_is_updated()
    {

        $products = Product::all()->last();
        $products->name ="UPDATED" . $products->name;
        $products->slug = "slug" . $products->slug;
        $request = $products->toArray();
        $response = $this->put("/products/" . $products->id, $request);
        $response->assertSessionHasNoErrors();
    }


    public function test_products_latest_products_is_deleted(){
        $products = Product::all()->last();
        $id = $products->id;
        $response = $this->delete("/products/" . $id);
        $response->assertRedirect("/products");
    }

}
