<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function an_authenticated_user_can_not_see_other_users_images()
    {
        $this->withoutExceptionHandling();
        
       $david = $this->signIn();

       $john = factory(User::class)->create(['name' => 'John']);

       $post = factory(Post::class)->create(['owner_id' => $john->id]);

       $this->get('/posts')->assertDontSee($post->path);
    }

    /** @test * */
    public function a_user_can_see_his_uploaded_images()
    {
        $this->signIn();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ]);

        $this->get('/posts')->assertSee($image->hashName());
    }

    /** @test **/
    public function guests_can_not_make_a_new_post()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ])->assertRedirect('login');
    }

    /** @test * */
    public function an_authenticated_user_can_upload_an_image_and_make_a_new_post()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ]);

        $this->assertCount(1, Storage::disk('public')->files('images'));

        $this->assertCount(1, $user->posts);

        $this->assertDatabaseHas('posts', [
            'path' => 'images/'.$image->hashName(),
            'owner_id' => $user->id
        ]);
    }

    /** @test * */
    public function an_image_is_required_for_creating_a_new_post()
    {
        $this->signIn();

        $this->post('/posts', [
            'image' => null
        ])->assertSessionHasErrors(['image']);
    }

    /** @test * */
    public function an_image_should_have_a_proper_format()
    {
        $this->signIn();

        $this->post('/posts', [
            'image' => UploadedFile::fake()->create('test.pdf')
        ])->assertSessionHasErrors(['image']);
    }
}
