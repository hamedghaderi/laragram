<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function users_can_view_their_own_settings()
    {
        $this->withoutExceptionHandling();

        $sina = $this->signIn();

        $this->get('/settings/users/'.$sina->id)
            ->assertSee($sina->name);
    }
}
