<?php

namespace Tests\Feature;

use App\Activity;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function when_creating_a_post_an_activity_would_be_created()
    {
        $this->withoutExceptionHandling();

        $post = create(Post::class);

        $this->assertDatabaseHas('activities', [
            'message' => 'post_created',
            'subject_id' => $post->id,
            'subject_type' => Post::class
        ]);

        $this->assertCount(1, $post->activities);
    }
}
