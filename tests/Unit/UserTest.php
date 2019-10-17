<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

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

       $this->assertInstanceOf(Collection::class, $john->followers);
    }

    /** @test **/
    public function it_can_follow_another_user()
    {
        $this->withoutExceptionHandling();

        $john = $this->signIn();

        $jane = factory(User::class)->create();

        $john->follow($jane);

        $this->assertTrue($john->followers->contains($jane));
    }

    /** @test **/
    public function it_can_check_if_is_following_someone_else()
    {
       $john = $this->signIn() ;

       $jane = factory(User::class)->create();

       $john->follow($jane);

       $this->assertTrue($john->isFollowing($jane));
    }

}
