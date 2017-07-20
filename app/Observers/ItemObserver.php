<?php

namespace App\Observers;

use App\Models\Item;
use App\Traits\NotificationTrait;

class ItemObserver {

	use NotificationTrait;

	public function created(Item $items) {
		$this->makeItemNotification($items, 'created');
	}

	public function deleted(Item $items) {
		$this->makeItemNotification($items, 'deleted');
	}

}
