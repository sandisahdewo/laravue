<?php 

namespace App\Traits;

use App\Notifications\ItemsNotification;

trait NotificationTrait {

	public function makeItemsNotification($items, $status = 'default') {
		$this->notify($items, $status);
	}

	public function notify($items, $status) {
        auth()->user()->notify(new ItemsNotification($items, $status));
	}
}
