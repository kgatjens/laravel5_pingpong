<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class FeedsLikes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feed_id',
        'anonymous_id',
        'onesignal_id'
    ];

    /**
     * The feed that belong to the like.
     */
    public function feed(){
        return $this->belongsTo('HepC\Models\Feeds', 'feed_id');
    }
}
