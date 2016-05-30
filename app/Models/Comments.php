<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    	'order',
    ];

    /**
     * The challenges that belong to the comment.
     */
    public function challenges()
    {
        return $this->belongsToMany('HepC\Models\Challenges', 'challenges_comments', 'comment_id', 'challenge_id');
    }

    /**
     * The feed that belong to the comment.
     */
    public function feeds()
    {
        return $this->belongsToMany('HepC\Models\Feeds', 'feeds_comments', 'comment_id', 'feed_id');
    }

    /**
     * Scope a query to order comments by custom "order" fiels
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
