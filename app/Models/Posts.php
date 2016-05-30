<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       	'title',
        'subtitle',
        'link',
    	'description',
    	'media_path',
        'access'
    ];

    /**
     * The comments that belong to the post.
     */
    public function comments()
    {
        return $this->belongsToMany('HepC\Models\Comments', 'posts_comments', 'post_id', 'comment_id');
    }

    /**
     * The likes that belong to the post.
     */
    public function likes(){
        return $this->hasMany('HepC\Models\PostsLikes', 'post_id');
    }
}
