<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conservation extends Model
{
    protected $table = 'status_conserve';
	
    protected $fillable = [
        'name',
        'code'
    ];
}
