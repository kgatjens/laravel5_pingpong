<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class PostsLikes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'anonymous_id',
        'onesignal_id'
    ];

    /**
     * The post that belong to the like.
     */
    public function post(){
        return $this->belongsTo('HepC\Models\Posts', 'post_id');
    }
}
