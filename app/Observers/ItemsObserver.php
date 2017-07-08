<?php

namespace App\Observers;

use App\Models\Items;
use App\Traits\NotificationTrait;

class ItemsObserver {

	use NotificationTrait;

	public function created(Items $items) {
		$this->makeItemsNotification($items, 'created');
	}

	public function deleted(Items $items) {
		$this->makeItemsNotification($items, 'deleted');
	}

}
