<?php

namespace Tests\Feature\Http\Controllers\Backend;
use App\Models\Category;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Container;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_categories_index_status()
    {
        $response = $this->get('/categories');

        $response->assertOk();
    }

    public function test_categories_index_url_goes_to_correct_view()
    {
        $response = $this->get('/categories');
        $response->assertViewIs("backend.categories.index");
    }

    public function test_categories_create_form_page_status()
    {
        $response = $this->get('/categories/create');
        $response->assertOk();
    }

    public function test_categories_create_form_goes_to_correct_view()
    {
        $response = $this->get('/categories/create');
        $response->assertViewIs("backend.categories.create");
    }

    public function test_categories_new_resource_is_create(){
        $generator = app(Generator::class);
        $request = [

            "name" => $generator ->name,
            "slug" => $generator ->slug,
            "is_active" => $generator ->boolean,
        ];
        $response =  $this->post("/categories" , $request);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/categories");


    }
    public function test_categories_existing_user_is_updated()
    {

        $categories = Category::all()->last();
        $categories->name ="UPDATED" . $categories->name;
        $categories->slug = "slug" . $categories->slug;
        $request = $categories->toArray();
        $response = $this->put("/categories/" . $categories->id, $request);
        $response->assertSessionHasNoErrors();
    }


    public function test_categories_latest_categories_is_deleted(){
        $categories = Category::all()->last();
        $id = $categories->category_id;
        $response = $this->delete("/categories/" . $id);
        $response->assertRedirect("/categories");
    }

}
