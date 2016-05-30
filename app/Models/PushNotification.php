<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'device_id',
    	'push_notification_type_id',
        'title',
        'message',
        'sent'
    ];

    /**
     * The types that belong to the push notification.
     */
    public function push_notification_types(){
        return $this->belongsTo('HepC\Models\PushNotificationType', 'push_notification_type_id');
    }

    /**
     * The devices that belong to the push notification.
     */
    public function devices(){
        return $this->belongsTo('HepC\Models\Devices', 'device_id');
    }
}
