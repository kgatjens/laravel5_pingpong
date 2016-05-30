<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotificationType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title',
    	'name',
    	'description',
        'slug'
    ];

    /**
     * Get all of the PushNotification for the PushNotificationType.
     */
    public function push_notifications()
    {
        return $this->hasMany('HepC\Models\PushNotification', 'push_notification_type_id');
    }
}
