<?php

namespace Tests\Feature;

use App\Following;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowingActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function after_request_following_a_user_an_activity_will_be_created()
    {
        $this->withoutExceptionHandling();
        
        $sina = $this->signIn();
        $milad = create(User::class);

        $sina->follow($milad);

        $this->assertDatabaseHas('activities', [
            'message' => 'Followed',
        ]);

        $following = Following::where('follower', $sina->id)
            ->where('following', $milad->id)
            ->first();

        $this->assertCount(1, $following->activity);
    }
}
