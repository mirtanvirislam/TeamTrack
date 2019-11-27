<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Member;
use App\Task;
use App\Team;
use App\User;
class ExampleTest extends TestCase
{
   use  RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    //home page comment added

    public function testBasicTest()
    {
        $response = $this->get('/')

        ->assertSee('Teamtrack');
    }

   // checked Login page 
    public function test_LoginPageTest()
    {
        $response = $this->get('/login')

        ->assertSee('login');
    }

//testing register page
    public function test_RegisterPageTest()
    {
        $response = $this->get('/register')

        ->assertSee('register');
    }
//if user has a valid name
    public function test_authenticated_user_has_a_name()
    {
        $user = factory(User::class)->make();
        $name=$user->name;

        $this->assertNotEmpty($name);
    }

//if user has a valid email
    public function test_authenticated_user_has_an_email_id()
    {
        $user = factory(User::class)->make();
        $email=$user->email;

        $this->assertNotEmpty($email);
    }


    
}
