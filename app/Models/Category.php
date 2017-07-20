<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'code', 
    	'name'
    ];

    public function items() {
    	return $this->hasMany(Item::class);
    }
}
