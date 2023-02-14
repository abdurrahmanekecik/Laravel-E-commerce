<?php

namespace Tests\Feature\Htpp\Backend;

use App\Models\Address;
use Database\Factories\AddressFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AddressControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page()
    {
        $response = $this->get('/users/1/address');

        $response->assertStatus(200);
    }
    public function test_index_goes_to_correct_view(){

        $response = $this->get('/users/1/address');
        $response->assertViewIs("backend.address.index");
    }

    public function test_address_create_form_page_status(){

        $response = $this->get('/users/1/address/create');
        $response->assertStatus(200);


    }




    public function test_address_create_goes_to_correct_view(){

        $response = $this->get('/users/1/address/create/');
        $response->assertViewIs("backend.address.create");
    }


    public function test_users_new_resource_is_create(){
        $addr = Address::factory()->make();
        $request = $addr->toArray();
        $response =  $this->post("/users/1/address" , $request);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/users/");


    }

    public function test_users_existing_address_is_updated()
    {
        $address = Address::all()->last();
        $address->city ="UPDATEDCİTY " . $address->city;
        $address->disctrict = "disctrict " . $address->disctrict;
        $request = $address->toArray();
        $response = $this->put("/users/1/address/" . $address->id, $request);
        $response->assertRedirect("/users/");
    }





    public function test_address_latest_address_is_deleted(){
        $address = Address::all()->last();
        $id = $address->id;
        $response = $this->delete("/users/1/address/" . $id);
        $response->assertRedirect("/users/");

    }
















}
