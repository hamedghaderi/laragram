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

    /** @test * */
    public function after_sending_a_request_the_follower_may_decline_the_request()
    {
        $this->withoutExceptionHandling();

        $iman = $this->signIn();
        $sina = factory(User::class)->create();

        $sina->follow($iman);

        $this->assertTrue($sina->hasRequestedFollowing($iman));

        $this->post('/followers/'.$sina->id.'/decline');

        $this->assertTrue($iman->hasDeclined($sina));
        $this->assertFalse($sina->hasRequestedFollowing($iman));
    }

    /** @test * */
    public function a_user_can_accept_another_user_following_request()
    {
        $this->withoutExceptionHandling();

        $iman = $this->signIn();
        $sina = factory(User::class)->create();

        $sina->follow($iman);

        $this->post('/followers/' . $sina->id . '/accept');

        $this->assertTrue($sina->isFollowing($iman));

        $this->assertDatabaseHas('followings', [
            'following' => $iman->id,
            'follower' => $sina->id,
            'status' => FollowingStatusManager::STATUS_ACCEPTED
        ]);
    }

    /** @test **/
    public function a_user_can_cancel_his_follow_reqeust()
    {
        $this->withoutExceptionHandling();

        $iman = create(User::class);
        $sina = $this->signIn(create(User::class, ['name' => 'Sina']));

        $sina->follow($iman);

        $this->post('/following/' . $iman->id . '/cancel');

        $this->assertFalse($sina->hasRequestedFollowing($iman));

        $this->assertDatabaseMissing('followings', [
            'following' => $iman->id,
            'follower' => $sina->id,
            'status' => FollowingStatusManager::STATUS_SUSPENDED
        ]);
    }

    /** @test **/
    public function users_can_not_follow_themselves()
    {
       $sina = $this->signIn();

       $this->post('/members/' . $sina->id)
           ->assertRedirect($sina->path());

       $this->assertDatabaseMissing('followings', [
            'follower'   => $sina->id,
           'following' => $sina->id
       ]);
    }
}
