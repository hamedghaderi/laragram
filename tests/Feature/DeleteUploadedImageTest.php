<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUploadedImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function guests_can_not_delete_a_post()
    {
        $post = factory(Post::class)->create();

        $this->delete('/posts/' . $post->id)
            ->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_delete_his_own_post()
    {
        $this->withoutExceptionHandling();

       $this->signIn();

       $post = factory(Post::class)->create(['owner_id' => auth()->id()]);

       $this->assertDatabaseHas('posts', ['path' => $post->path]);

       $this->delete('/posts/' . $post->id)->assertRedirect('/posts');

       $this->assertDatabaseMissing('posts', ['path' => $post->path]);
    }

    /** @test **/
    public function a_user_can_not_delete_other_users_post()
    {
        $david = $this->signIn();

        $john = factory(User::class)->create(['name' => 'John']);

       $post = factory(Post::class) ->create(['owner_id' => $john->id]);

       $this->delete('/posts/' . $post->id)
           ->assertStatus(403);
    }
}
