<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_member_can_follow_another_member()
    {
        $this->withoutExceptionHandling();

       $sina =  $this->signIn();

       $john = factory(User::class)->create();

       $this->post('/members/' . $john->id);

       $this->assertDatabaseHas('followings', [
           'follower' => $sina->id,
           'following' => $john->id
       ]);

       $this->assertTrue($sina->isFollowing($john));
    }
}
