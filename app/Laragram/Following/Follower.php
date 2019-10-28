<?php

namespace App\Laragram\Following;

use App\User;

trait Follower
{

    /**
     * Check if a user has a follower request from given user.
     *
     * @param  User  $user
     * @return bool
     */
    public function hasRequestedFollower(User $user)
    {
        return $this->followers()
            ->where('status', FollowingStatusManager::STATUS_SUSPENDED)
            ->where('follower', $user->id)
            ->exists();
    }

    /**
     * A user may have many followers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'followings',
            'following',
            'follower'
        );
    }
}