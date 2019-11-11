<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_user_can_upload_an_avatar()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $user = create(User::class);

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $this->postJson($user->path() . '/avatars', [
            'avatar' => $avatar
        ])->assertJson(['status' => 201, 'data' => ['avatar' => 'avatars/' . $avatar->hashName()]]);

        $this->assertCount(1, Storage::disk('public')
            ->files('avatars'));

        $this->assertDatabaseHas('users', [
            'avatar' => 'avatars/' . $avatar->hashName()
        ]);
    }
}
