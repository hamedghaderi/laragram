<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_user_can_upload_an_avatar()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $user = $this->signIn();

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $this->postJson($user->path() . '/avatars', [
            'avatar' => $avatar
        ])->assertJson(['status' => 201, 'user' => ['avatar' => 'avatars/' . $avatar->hashName()]]);

        $this->assertCount(1, Storage::disk('public')
            ->files('avatars'));

        $this->assertDatabaseHas('users', [
            'avatar' => 'avatars/' . $avatar->hashName()
        ]);

        $this->get($user->path())->assertSee('avatars/' . $avatar->hashName());
    }

    /** @test **/
    public function an_avatar_should_be_a_valid_image()
    {
        Storage::fake('public');

        $user = create(User::class);

        $avatar = UploadedFile::fake()->create('document.pdf');

        $this->postJson($user->path() . '/avatars', [
            'avatar' => $avatar
        ])->assertJsonValidationErrors(['avatar']);
    }

    /** @test **/
    public function avatar_is_required()
    {
        Storage::fake('public');

        $user = create(User::class);

        $this->postJson($user->path() . '/avatars', [
            'avatar' => null
        ])->assertJsonValidationErrors(['avatar']);
    }
}

