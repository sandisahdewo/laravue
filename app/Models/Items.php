<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Items extends Model
{
    use Notifiable;
	
    protected $fillable = [
    	'code', 
    	'name'
    ];

    protected $hidden = [
    	'created_at', 
    	'updated_at'
    ];
}
