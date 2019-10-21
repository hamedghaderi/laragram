<?php

namespace App;

use App\Laragram\Following\FollowingStatusManager;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user may have many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'owner_id');
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
            'follower',
            'following'
        );
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
           'following',
           'follower'
       );
    }

    /**
     * A user can follow another user.
     *
     * @param  User  $user
     */
    public function follow(User $user)
    {
        $this->followers()->attach($user, [
            'status' => FollowingStatusManager::STATUS_SUSPENDED
        ]);
    }

    /**
     * Check if a user has followed another user.
     *
     * @param  User  $user
     * @return mixed
     */
    public function hasRequestedFollowing(User $user)
    {
       return $this->followers()
           ->where('status', FollowingStatusManager::STATUS_SUSPENDED)
           ->where('following', $user->id)
           ->exists();
    }

    /**
     * Decline a user from requested links
     *
     * @param  User  $user
     */
    public function decline(User $user)
    {
        $this->followings()->sync([$user->id => [
            'status' => FollowingStatusManager::STATUS_DECLINED
        ]]);
    }

    public function hasDeclined(User $user)
    {
       return $this->followings()
           ->where('follower', $user->id)
           ->where('status', FollowingStatusManager::STATUS_DECLINED)
           ->exists();
    }

}
