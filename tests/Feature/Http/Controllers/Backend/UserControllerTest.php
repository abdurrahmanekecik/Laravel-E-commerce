<?php

namespace Tests\Feature\Http\Controllers\Backend;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Container;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_index_status()
    {
        $response = $this->get('/users');

        $response->assertOk();
    }

    public function test_users_index_url_goes_to_correct_view()
    {
        $response = $this->get('/users');
        $response->assertViewIs("backend.users.index");
    }

    public function test_users_create_form_page_status()
    {
        $response = $this->get('/users/create');
        $response->assertOk();
    }

    public function test_users_create_form_goes_to_correct_view()
    {
        $response = $this->get('/users/create');
        $response->assertViewIs("backend.users.create");
    }

    public function test_users_new_resource_is_create(){
        $generator = app(Generator::class);
        $request = [

            "name" => $generator ->name,
            "email" => $generator ->email,
            "password" => "deneme",
            "password_confirmation" => "deneme",
            "is_admin" => $generator ->boolean,
            "is_active" => $generator ->boolean,
        ];
        $response =  $this->post("/users" , $request);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/users");


    }
    public function test_users_existing_user_is_updated()
    {

        $user = User::all()->last();
        $user->name ="UPDATED" . $user->name;
        $user->email = "email" . $user->email;
        $request = $user->toArray();
        $response = $this->put("/users/" . $user->id, $request);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/users");
    }


    public function test_users_latest_users_is_deleted(){
        $user = User::all()->last();
        $id = $user->id;
        $response = $this->delete("/users/" . $id);
        $response->assertRedirect("/users");
    }

}
