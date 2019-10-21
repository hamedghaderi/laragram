<?php

namespace Tests\Feature;

use App\Laragram\Following\FollowingStatusManager;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_member_can_follow_another_member()
    {
        $this->withoutExceptionHandling();

        $sina = $this->signIn();

        $john = factory(User::class)->create();

        $this->post('/members/'.$john->id);

        $this->assertDatabaseHas('followings', [
            'follower' => $sina->id,
            'following' => $john->id
        ]);

        $this->assertTrue($sina->hasRequestedFollowing($john));
    }

    /** @test * */
    public function after_sending_a_follow_request_the_request_should_get_accepted_to_establish()
    {
        $this->withoutExceptionHandling();

        $sina = $this->signIn();

        $iman = factory(User::class)->create();

        $this->post('/members/'.$iman->id);

        $this->assertDatabaseHas('followings', [
            'follower' => $sina->id,
            'following' => $iman->id,
            'status' => FollowingStatusManager::STATUS_SUSPENDED
        ]);
    }

    /** @test **/
    public function after_sending_a_request_the_follower_may_decline_the_request()
    {
        $this->withoutExceptionHandling();

        $iman = $this->signIn();
        $sina = factory(User::class)->create();

        $sina->follow($iman);

        $this->assertTrue($sina->hasRequestedFollowing($iman));

        $this->post('/followers/' . $sina->id . '/decline');

        $this->assertTrue($iman->hasDeclined($sina));
        $this->assertFalse($sina->hasRequestedFollowing($iman));
    }
}
