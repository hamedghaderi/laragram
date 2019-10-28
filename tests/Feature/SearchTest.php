<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_search_for_other_users_by_their_name_username_or_email()
    {
        $this->withoutExceptionHandling();

        $search = 'john';

        create(User::class, ['name' => 'Test', 'email' => 'test@gmail.com', 'username' => 'testuser'], 1);
        create(User::class, ['name' => 'Mr. yjohnm']);
        create(User::class, ['email' => 'youjohn@gmail.com']);
        factory(User::class)->state('username')->create(['username' => 'parisjohn24']);

        $result = $this->getJson("/users/search?q=$search")->json();

        $this->assertCount(3, $result);
    }
}
