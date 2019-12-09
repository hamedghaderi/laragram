<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ManageUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function after_registering_a_new_user_it_should_get_a_unique_hashed_username()
    {
        $this->withoutExceptionHandling();

        $password = bcrypt('password');

        $user = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => $password,
            'password_confirmation' => $password
        ];

        $this->post('/register', $user);

        $this->assertDatabaseHas('users', [
            'name' => $user['name'],
            'email' => $user['email'],
        ]);

        $user = User::first();

        $this->assertNotNull($user->username);
    }

    /** @test * */
    public function users_can_update_their_username()
    {
        $this->withoutExceptionHandling();

        $user = create(User::class);

        $this->patch($user->path().'/username', [
            'username' => 'foobar'
        ]);

        $this->assertEquals('foobar', $user->fresh()->username);
    }

    /** @test * */
    public function username_is_required_for_update()
    {
        $user = create(User::class);

        $this->patch($user->path().'/username', [
            'username' => null
        ])->assertSessionHasErrors(['username']);
    }

    /** @test * */
    public function username_should_be_unique()
    {
        $john = create(User::class);

        $matt = create(User::class);

        $this->patch($john->path().'/username', [
            'username' => $matt->username
        ])->assertSessionHasErrors(['username']);
    }

    /** @test * */
    public function username_can_get_updated_to_current_username_for_a_user()
    {
        $john = create(User::class, ['username' => 'john']);

        $this->patch($john->path().'/username', [
            'username' => $john->username
        ])->assertSessionDoesntHaveErrors(['username']);
    }

    /** @test * */
    public function a_username_can_only_contains_meaningful_words_and_numbers_and_underline()
    {
        $john = create(User::class);

        $this->patch($john->path().'/username', [
            'username' => 'hello.'
        ])->assertSessionHasErrors(['username']);
    }

    /** @test * */
    public function users_can_update_their_password()
    {
        $this->withoutExceptionHandling();

        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password'
        ]);

        $this->assertTrue(Hash::check('new-password', $john->fresh()->password));
    }

    /** @test * */
    public function for_changing_password_current_password_is_required()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => null,
            'password' => 'new-password',
            'password_confirmation' => 'new-password'
        ])->assertSessionHasErrors(['current-password']);
    }

    /** @test * */
    public function password_is_required_for_update()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'password',
            'password' => null,
            'password_confirmation' => 'new-password'
        ])->assertSessionHasErrors(['password']);
    }

    /** @test * */
    public function password_confirmation_is_required_for_update()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => null,
        ])->assertSessionHasErrors(['password']);
    }

    /** @test * */
    public function current_password_should_be_at_least_8_chars()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'pass',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])->assertSessionHasErrors(['current-password']);
    }

    /** @test * */
    public function password_should_be_at_least_8_chars()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'password',
            'password' => 'new',
            'password_confirmation' => 'new-password',
        ])->assertSessionHasErrors(['password']);
    }

    /** @test * */
    public function confirmation_password_be_exactly_same_as_password()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'changed-password',
        ])->assertSessionHasErrors(['password']);
    }

    /** @test * */
    public function when_updating_password_the_password_should_exists_for_current_user()
    {
        $john = create(User::class);

        $this->patch($john->path().'/password', [
            'current-password' => 'this-is-not-a-true-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])->assertSessionHasErrors('current-password');
    }
}
