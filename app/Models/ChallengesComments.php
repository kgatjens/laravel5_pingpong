<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengesComments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'challenge_id',
        'comment_id',
        'anonymous_id',
        'onesignal_id'
    ];
}
