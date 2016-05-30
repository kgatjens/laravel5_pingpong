<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class PostsComments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'comment_id',
        'anonymous_id',
        'onesignal_id'
    ];
}
