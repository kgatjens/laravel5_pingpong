<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class PostsAccess extends Model
{   
    protected $table = 'posts_access';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'access_id',
        'status'
    ];
}
