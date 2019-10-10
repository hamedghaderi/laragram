<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

}
