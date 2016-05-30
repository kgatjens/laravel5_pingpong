<?php

namespace HepC\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'onesignal_id'
    ];

    /**
     * Get all of the PushNotification for the devices.
     */
    public function push_notifications()
    {
        return $this->hasMany('HepC\Models\PushNotification', 'device_id');
    }

    /**
     * Create/Update a device
     * @param $oneSignalId
     * @return Device
     */
    public static function processDevice($oneSignalId){
        $device = Devices::where('onesignal_id','=',$oneSignalId)->first();
        try {
            if (!$device) {
                $device = new Devices([
                    'onesignal_id' => $oneSignalId
                ]);
            } else {
                $device->updated_at = \Carbon\Carbon::now();
            }
            $device->save();
            return $device;
        }catch(QueryException $e){
            return $e;
        }
    }

    /**
     * Scope a query to only include a specify device
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDevice($query, $onesignal_id)
    {
        return $query->where('onesignal_id', $onesignal_id);
    }
}
