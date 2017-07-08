<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function countUnreadNotification() {
    	return count(auth()->user()->unreadNotifications);
    }

    public function getUnreadNotification() {
    	$result = [];
    	foreach(auth()->user()->unreadNotifications as $key => $notification) {
    		$result[$key]['id'] = $notification->id;
            $result[$key]['data'] = $notification->data;
            $result[$key]['read_at'] = $notification->read_at;
    	}
    	return $result;
    }

    public function getAllNotification() {
        $result = [];
        foreach(auth()->user()->notifications as $key => $notification) {
            $result[$key]['id'] = $notification->id;
            $result[$key]['data'] = $notification->data;
            $result[$key]['read_at'] = $notification->read_at;
        }
        return $result;
    }

    public function markAsReadNotification($id) {
    	foreach(auth()->user()->unreadNotifications as $notification) {
    		if($notification->id == $id) {
	    		$notification->markAsRead();
    		}
    	}
    	return response()->json(['success' => true]);
    }
}
