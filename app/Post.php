<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['path', 'owner_id'];

    /**
     * Each post may have many activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activities()
    {
       return $this->morphMany(Activity::class, 'subject' );
    }

    public function addActivity($message)
    {
       $this->activities()->create([
           'message' => $message
       ]);
    }
}
