<?php

namespace App\Laragram\Following;

use App\Activity;
use App\Observers\FollowingObserver;
use App\User;

trait Following
{

    /**
     * Check if a user has followed another user.
     *
     * @param  User  $user
     * @return mixed
     */
    public function hasRequestedFollowing(User $user)
    {
        return $this->followings()
            ->where('status', FollowingStatusManager::STATUS_SUSPENDED)
            ->where('following', $user->id)
            ->exists();
    }

    /**
     * A user may have many followings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(
            User::class,
            'followings',
            'follower',
            'following'
        );
    }

    /**
     * A user can follow another user.
     *
     * @param  User  $user
     */
    public function follow(User $user)
    {
        $this->followings()->attach($user, [
            'status' => FollowingStatusManager::STATUS_SUSPENDED
        ]);
    }

    /**
     * Decline a user from requested links
     *
     * @param  User  $user
     */
    public function decline(User $user)
    {
        $this->followers()->sync([
            $user->id => [
                'status' => FollowingStatusManager::STATUS_DECLINED
            ]
        ]);
    }

    /**
     * Check if given user has declined.
     *
     * @param  User  $user
     * @return bool
     */
    public function hasDeclined(User $user)
    {
        return $this->followers()
            ->where('follower', $user->id)
            ->where('status', FollowingStatusManager::STATUS_DECLINED)
            ->exists();
    }

    /**
     *  Accept another user following request.
     *
     * @param  User  $user
     * @return mixed
     */
    public function accept(User $user)
    {
       return $this->followers()->sync([
         $user->id => [
             'status' => FollowingStatusManager::STATUS_ACCEPTED
           ]
       ]);
    }

    /**
     * Check if a user has followed
     *
     * @param  User  $user
     * @return bool
     */
    public function isFollowing(User $user)
    {
        return $this->followings()
            ->where('following', $user->id)
            ->where('status', FollowingStatusManager::STATUS_ACCEPTED)
            ->exists();
    }
}