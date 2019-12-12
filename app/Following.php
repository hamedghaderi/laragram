<?php

namespace App;

use App\Laragram\Following\FollowingStatusManager;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $guarded = [];

    public function activity()
    {
       return $this->morphMany(Activity::class, 'subject');
    }

    public function addActivity($message)
    {
       return $this->activity()->create(compact('message'));
    }

    public function scopeFollower($query, User $user)
    {
       return $query->where('follower', $user->id);
    }

    public function scopeFollowing($query, User $user)
    {
       return $query->where('following', $user->id) ;
    }

    public function scopeSuspend($query)
    {
       return $query->where('status', FollowingStatusManager::STATUS_SUSPENDED);
    }
}
