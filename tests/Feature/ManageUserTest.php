<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function after_registering_a_new_user_it_should_get_a_unique_hashed_username()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->raw();
        $user['password_confirmation'] = $user['password'];

        $this->post('/register', $user);

        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'email' => $user['email'],
        ]);
    }
}
