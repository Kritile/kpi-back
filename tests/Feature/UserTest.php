<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * Login test
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->post('/api/user/login',['email'=>'admin@admin.com', 'password'=>'password']);
        $response->assertJson(fn (AssertableJson $json)=>
        $json->has('token'));
    }
    public function test_login_invalid_data()
    {
        $response = $this->post('/api/user/login',['email'=>'admin@admin.com', 'password'=>'password1']);
        $response->assertStatus(401);
    }
    /**
     * Register test
     *
     * @return void
     */
    public function test_register()
    {
        $email = fake()->email();
        $name = fake()->name();
        $response = $this->post('/api/user/create',['name' => $name,'email'=>$email, 'password'=>'test']);
        $response->assertJson(fn (AssertableJson $json)=>
        $json->has('token'));
        User::where('email','=',$email)->delete();
    }

    public function test_register_exist_email()
    {
        $email = "admin@admin.com";
        $name = fake()->name();
        $response = $this->post('/api/user/create',['name' => $name,'email'=>$email, 'password'=>'test']);
        $response->assertStatus(400);
    }
}
