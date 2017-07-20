<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class NotificationController extends Controller
{
    public function countUnreadNotification() {
    	return count(JWTAuth::parseToken()->authenticate()->unreadNotifications);
    }

    public function getUnreadNotification() {
    	$result = [];
    	foreach(JWTAuth::parseToken()->authenticate()->unreadNotifications as $key => $notification) {
    		$result[$key]['id'] = $notification->id;
            $result[$key]['data'] = $notification->data;
            $result[$key]['read_at'] = $notification->read_at;
    	}
    	return $result;
    }

    public function getAllNotification() {
        $result = [];
        foreach(JWTAuth::parseToken()->authenticate()->notifications as $key => $notification) {
            $result[$key]['id'] = $notification->id;
            $result[$key]['data'] = $notification->data;
            $result[$key]['read_at'] = $notification->read_at;
        }
        return $result;
    }

    public function markAsReadNotification($id) {
    	foreach(JWTAuth::parseToken()->authenticate()->unreadNotifications as $notification) {
    		if($notification->id == $id) {
	    		$notification->markAsRead();
    		}
    	}
    	return response()->json(['success' => true]);
    }
}
