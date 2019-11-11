<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_user_can_search_for_other_users_by_their_name_username_or_email()
    {
        $this->withoutExceptionHandling();

        config(['scout.driver' => 'algolia']);

        $search = 'foobar';

        $test = create(User::class, ['name' => 'Test', 'email' => 'test@gmail.com', 'username' => 'testuser']);
        $test1 = create(User::class, ['name' => 'Mr. foobar']);
        $test2 = create(User::class, ['email' => 'foobar@gmail.com']);
        $test3 = factory(User::class)->state('username')->create(['username' => 'foobar-24']);

        do {
            sleep(.25);

            $result = $this->getJson("/users/search?q=$search")->json()['data'];
        } while (count($result) !== 3);

        $this->assertCount(3, $result);

        User::latest()->take(4)->unsearchable();
    }
}
