<?php

namespace Tests\Unit;

use App\Activity;
use App\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function it_can_have_many_activities()
    {
        $post = factory(Post::class)->create();

        $this->assertInstanceOf(Collection::class, $post->activities);
    }

    /** @test **/
    public function it_can_add_an_activity()
    {
       $post = factory(Post::class)->create();

       $post->addActivity('post_updated');

       $this->assertDatabaseHas('activities', [
           'message' => 'post_updated',
           'subject_id' => $post->id,
           'subject_type' => Post::class
       ]);
    }
}
