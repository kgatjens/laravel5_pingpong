<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'description',
    ];

    /**
     * The comments that belong to the challenges.
     */
    public function comments()
    {
        return $this->belongsToMany('HepC\Models\Comments', 'challenges_comments', 'challenge_id', 'comment_id');
    }

    /**
     * The likes that belong to the challenges.
     */
    public function likes(){
        return $this->hasMany('HepC\Models\ChallengesLikes', 'challenge_id');
    }
}
