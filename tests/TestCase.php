<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        DB::statement(DB::raw('PRAGMA foreign_keys = ON;'));
    }

    public function signIn($user = null)
    {
       $user = $user ?: factory(User::class)->create();

       $this->be($user);

       return $user;
    }
}
