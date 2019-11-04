<?php

namespace App;

use App\Laragram\Following\Follower;
use App\Laragram\Following\Following;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

/**
 * Class User
 *
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, Follower, Following, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
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
     * Event boot for User model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->username) {
                $user->username = $user->generateUsername();
            }
        });
    }

    /**
     * Get the path of a user
     *
     * @return string
     */
    public function path()
    {
       return '/users/' . $this->id;
    }

    /**
     * Generate a username for user.
     *
     * @return string
     */
    function generateUsername() : string
    {
        $username = bcrypt($this->email);

        $username = preg_replace('/[.\/]/', str_shuffle('eiwq'), $username).time();

        while(User::whereUsername($username)->exists())  {
            $this->generateUsername();
        }

        return $username;
    }

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
     * Add user path to search results.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray() + ['path' => $this->path()];
    }
}
