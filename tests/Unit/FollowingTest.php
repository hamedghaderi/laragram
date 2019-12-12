<?php

namespace Tests\Unit;

use App\Following;
use App\Laragram\Following\FollowingStatusManager;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowingTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function it_can_add_activity()
    {
        $following = factory(Following::class)->create();

        $following->addActivity('Followed');

        $this->assertCount(1, $following->activity);
        $this->assertEquals('Followed', $following->activity[0]->message);
    }

    /** @test **/
    public function it_has_follower()
    {
        $user = factory(User::class)->create();
        $following = factory(Following::class)->create(['follower' => $user->id]);

        $this->assertTrue($following->follower($user)->exists());
    }

    /** @test **/
    public function it_has_following()
    {
        $user = factory(User::class)->create();
        $following = factory(Following::class)->create(['following' => $user->id]);

        $this->assertTrue($following->following($user)->exists());
    }

    /** @test **/
    public function it_is_suspend()
    {
       $following = factory(Following::class) ->create(['status' => FollowingStatusManager::STATUS_SUSPENDED]);

       $this->assertCount(1, Following::suspend()->get());
    }
}
