<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $table = 'status_presences';
	
    protected $fillable = [
        'name',
        'code'
    ];
}
