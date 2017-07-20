<?php 

namespace App\Traits;

use App\Notifications\ItemNotification;

trait NotificationTrait {

	public function makeItemNotification($items, $status = 'default') {
		$this->notify($items, $status);
	}

	public function notify($items, $status) {
        auth()->user()->notify(new ItemNotification($items, $status));
	}
}
