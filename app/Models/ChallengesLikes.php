<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengesLikes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'challenge_id',
        'anonymous_id',
        'onesignal_id'
    ];

    /**
     * The challenge that belong to the like.
     */
    public function challenge(){
        return $this->belongsTo('HepC\Models\Challenge', 'challenge_id');
    }
}
