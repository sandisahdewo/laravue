<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Item extends Model
{
    use Notifiable;
	
    protected $fillable = [
    	'code', 
    	'name',
        'category_id'
    ];

    protected $hidden = [
    	'created_at', 
    	'updated_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
