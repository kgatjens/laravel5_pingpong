<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{

    protected $table = 'access';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'slug',
        'name',
        'description',
    ];

    /**
     * The access that belong to the post.
     */
    public function comments()
    {
        return $this->belongsToMany('HepC\Models\Comments', 'posts_access', 'post_id', 'comment_id');
    }

}
