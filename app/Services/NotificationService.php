<?php

namespace App\Services;

class NotificationService{

    /**
     * Creates a notification item for a desired action.
     * @param $type required
     * indicates what type of notification will the user receive
     * @param $icon (optional) 
     * indicates what icon from the Iconify libary will be used on the notification
     * @param $message required 
     * is the message that will be shown to the user for this notification
     * @param $subheader (optional) 
     * indicates what if the notification should have a subheader
     */
    
    public static function notificationItem(String $type, String $icon, String $message, String $header = 'Notification' ,String $subheader = '', $data = []) : Array
    {
        return [
            'type' => $type,
            'icon' => $icon,
            'message' => $message,
            'header' => $header,
            'subheader' => $subheader,
            'data' => $data,
        ];
    }
    
    public static function notificationArray(array $notificationitems){
        return [
            'notifications' => $notificationitems
        ];
    }

}