<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use \GetStream\StreamLaravel\Eloquent\ActivityTrait;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activityVerb()
    {
        return 'created_task';
    }

    public function activityExtraData()
    {
        return array('name'=> $this->name);
    }

    public function activityNotify()
    {
        $targetFeed = \FeedManager::getNotificationFeed($this->user->id);
        return [$targetFeed];
    }
}