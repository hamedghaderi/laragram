<?php

namespace Tests\Unit;

use App\Laragram\Following\FollowingStatusManager;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_know_their_path()
    {
       $user = create(User::class);

       $this->assertEquals('/users/' . $user->id, $user->path());
    }

    /** @test **/
    public function it_may_has_many_posts()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn() ;

        $post = factory(Post::class)->create();

        $this->assertInstanceOf(Collection::class, $user->posts);
    }

    /** @test **/
    public function it_may_have_many_followers()
    {
        $this->withoutExceptionHandling();

       $john = $this->signIn();

       $jane = factory(User::class)->create();

       $john->follow($jane);

       $this->assertInstanceOf(Collection::class, $jane->followers);
       $this->assertTrue($john->hasRequestedFollowing($jane));
    }

    /** @test **/
    public function it_may_have_many_followings()
    {
       $this->withoutExceptionHandling();

        $john = $this->signIn();

        $jane = factory(User::class)->create();

        $john->follow($jane);

        $this->assertInstanceOf(Collection::class, $john->followings);
        $this->assertTrue($jane->hasRequestedFollower($john));
    }

    /** @test **/
    public function it_can_follow_another_user()
    {
        $this->withoutExceptionHandling();

        $john = $this->signIn();

        $jane = factory(User::class)->create();

        $john->follow($jane);

        $this->assertTrue($john->followings->contains($jane));
    }

    /** @test **/
    public function it_can_check_if_is_following_someone_else()
    {
       $john = $this->signIn() ;

       $jane = factory(User::class)->create();

       $john->follow($jane);

       $this->assertTrue($john->hasRequestedFollowing($jane));
    }

    /** @test **/
    public function it_can_decline_a_following_request()
    {
       $iman = $this->signIn() ;

       $sina = factory(User::class)->create();

       $sina->follow($iman);

       $iman->decline($sina);

       $this->assertDatabaseHas('followings', [
           'follower' => $sina->id,
           'following' => $iman->id,
           'status' => FollowingStatusManager::STATUS_DECLINED
       ]);
    }

    /** @test **/
    public function it_can_check_if_a_user_has_declined()
    {
        $iman = $this->signIn() ;

        $sina = factory(User::class)->create();

        $sina->follow($iman);

        $iman->decline($sina);

        $this->assertTrue($iman->hasDeclined($sina));
    }

    /** @test **/
    public function it_can_accept_a_request_from_another_user()
    {
       $iman = $this->signIn() ;

       $sina  = factory(User::class)->create()   ;

       $sina->follow($iman);

       $iman->accept($sina);

       $this->assertTrue($sina->isFollowing($iman));
    }

    /** @test **/
    public function it_can_check_if_a_user_is_following_them()
    {
       $iman = $this->signIn();

       $sina = factory(User::class)->create();

       $sina->follow($iman);
       $iman->accept($sina);

       $this->assertTrue($sina->isFollowing($iman));
    }

}
