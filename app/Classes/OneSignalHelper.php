<?php
/*
Class Name: OneSignalHelper
Description: Send push notification using OneSignal
Version: 1.0
Author: Hangar - Jose M.
Author URI: http://thehangar.cr
*/
namespace HepC\Classes;

use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response;

use HepC\Models\Devices;
use HepC\Models\PushNotificationType;
use HepC\Models\PushNotification;
use HepC\Models\Challanges;
use HepC\Models\ChallangesLikes;
use HepC\Models\ChallangesComments;
use HepC\Models\Feeds;
use HepC\Models\FeedsLikes;
use HepC\Models\FeedsComments;
use HepC\Models\Posts;
use HepC\Models\PostsLikes;
use HepC\Models\PostsComments;
use HepC\Models\Access;
use HepC\Models\PostsAccess;

class OneSignalHelper
{
    public $push_types_array;
    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new OneSignalHelper();
        }
        return static::$instance;
    }

    /**
     * Create the array of push_types
     * OneSignalHelper constructor.
     */
    protected function __construct()
    {
        $pushTypes = PushNotificationType::all();
        $this->push_types_array = $this->pushTypeToArray($pushTypes);
    }

    /**
     * Convert the pushTypes to a array with an easier format to process
     * @param $pushTypes
     * @return array
     */
    protected function pushTypeToArray($pushTypes){
        $push_types_array = [];
        foreach($pushTypes as $pushType){
            $push_types_array[$pushType->slug] = $pushType->id;
        }
        return $push_types_array;
    }

    /**
     * @param $body array
     * @param string $content_type
     * @return GuzzleHttp\Client
     */
     public static function set_client($body, $content_type = 'application/json'){
        //Guzzle: Create a new Client
        //http://docs.guzzlephp.org/en/latest/quickstart.html#making-a-request
        $client = new GuzzleHttp\Client([
            'base_url' => ['https://onesignal.com/'],
            'defaults' => [
                'headers'  => ['content-type' => $content_type, 'Accept' => $content_type],
                'body' => json_encode($body),
            ],
        ]);
        return $client;
    }

    /**
     * Send a push notification to the $playerId
     * @param string $playerId
     * @param string $message
     * @return bool|mixed|string
     */
     public static function send_push($playerId = 'bdf0f786-e1bc-4e64-b4cf-fee428ab21a8', $message = 'The Message', $title = 'The Title'){
         try {
             //Create the body data
             $data = [
                 "app_id" => $_ENV['ONESIGNAL_ID'],
                 "data" => [],
                 "contents" => ["en" => $message],
                 "headings" => ["en" => $title],
                 "include_player_ids" => [$playerId]    //Yo can add a list of playerIds
             ];
             //Call the create client method
             $client = self::set_client([]);
             //Make the request
             //https://guzzle.readthedocs.org/en/5.3/clients.html#sending-requests
             $request = $client->post('https://onesignal.com/api/v1/notifications',[
                 'json' => $data
             ]);
             //Validate the status code
             if ($request->getStatusCode()== 200){
                 return true;
             }
             return false;
         }
         catch (GuzzleHttp\Exception\ClientException $e) {
             return false;
         }
    }

    /**
     * Select the correct method to create the push notification
     * @param $type
     * @param $object
     */
    public function createPushNotification($type, $object){
        switch ($type) {
            case 'like-feed':
                return $this->createPushNotificationLikeFeed($type, $object);
                break;
            case 'comment-feed':
                return $this->createPushNotificationCommentFeed($type, $object);
                break;
        }
    }

    /**
     * Enqueue the push notification
     * @param PushNotification $pushNotificationObj
     * @return bool
     */
    public function enqueuePush(PushNotification $pushNotificationObj){
        $job = (new SendPushNotification($pushNotificationObj))->delay(5)->onQueue('push');
        $this->dispatch($job);
        return true;
    }

    /**
     * Create a push notification of the feed like
     * @param $type
     * @param Feeds $object
     * @return boolean
     */
    public function createPushNotificationLikeFeed( $type, Feeds $object){
        // 1) set the message
        $message    = 'Someone likes your feed.';
        
        // 2) get the device
        $onesignal_id = $object->onesignal_id;
        $device = Devices::Device($onesignal_id)->first();

        // 3) create the notification
        $notification = new PushNotification([
            'message'   => $message,
            'sent'      => false,
            'title'     => 'like-feed',
            'device_id' => $device->id,
            'push_notification_type_id' => $this->push_types_array[$type]
        ]);
        $notification->save();
        
        // 4) send the push notification
        $sent = $this->send_push($device->onesignal_id, $message, 'Like feed');

        // 5) if notification was sent, change the state
        if( $sent ){
            $notification->sent = true;
            $notification->save();
        }

        // return
        return $notification->sent;
    }

    /**
     * Create a push notification of the feed comments
     * @param $type
     * @param Feeds $object
     * @return boolean
     */
    public function createPushNotificationCommentFeed( $type, Feeds $object){
        // 1) set the message
        $message    = 'Someone comment your feed.';
        
        // 2) get the device
        $onesignal_id = $object->onesignal_id;
        $device = Devices::Device($onesignal_id)->first();

        // 3) create the notification
        $notification = new PushNotification([
            'message'   => $message,
            'sent'      => false,
            'title'     => 'comment-feed',
            'device_id' => $device->id,
            'push_notification_type_id' => $this->push_types_array[$type]
        ]);
        $notification->save();
        
        // 4) send the push notification
        $sent = $this->send_push($device->onesignal_id, $message, 'Comment feed');

        // 5) if notification was sent, change the state
        if( $sent ){
            $notification->sent = true;
            $notification->save();
        }

        // return
        return $notification->sent;
    }
}