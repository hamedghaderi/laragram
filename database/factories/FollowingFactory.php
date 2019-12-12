<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Following::class, function (Faker $faker) {
    return [
        'follower' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'following' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'status' => \App\Laragram\Following\FollowingStatusManager::STATUS_ACCEPTED,
    ];
});
