<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_user_can_see_an_uploaded_image()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ]);

        $this->get('/posts')->assertSee($image->hashName());
    }

    /** @test * */
    public function a_user_can_upload_an_image_and_make_a_new_post()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ]);

        $this->assertCount(1, Storage::disk('public')->files('images'));

        $this->assertDatabaseHas('posts', [
            'path' => 'images/'.$image->hashName()
        ]);
    }

    /** @test * */
    public function an_image_is_required_for_creating_a_new_post()
    {
        $this->post('/posts', [
            'image' => null
        ])->assertSessionHasErrors(['image']);
    }

    /** @test * */
    public function an_image_should_have_a_proper_format()
    {
        $this->post('/posts', [
            'image' => UploadedFile::fake()->create('test.pdf')
        ])->assertSessionHasErrors(['image']);
    }
}
