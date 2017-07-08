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
            $result[$key]['name'] = $notification->data['item_name'];
    		$result[$key]['status'] = $notification->data['status'];
    	}
    	return $result;
    }

    public function markAsReadNotification($id) {
    	foreach(auth()->user()->unreadNotifications as $notification) {
    		if($notification->id == $id) {
	    		$notification->markAsRead();
	    		$notification->delete();
    		}
    	}
    	return response()->json(['success' => true]);
    }
}
