<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'challenge_id',
        'onesignal_id'
    ];

    /**
     * The comments that belong to the feed.
     */
    public function comments()
    {
        return $this->belongsToMany('HepC\Models\Comments', 'feeds_comments', 'feed_id', 'comment_id');
    }

    /**
     * The likes that belong to the feed.
     */
    public function likes(){
        return $this->hasMany('HepC\Models\FeedsLikes', 'feed_id');
    }
}
