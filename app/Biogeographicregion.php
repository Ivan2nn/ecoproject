<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biogeographicregion extends Model
{
    protected $table = 'biogeographicregions';
	
    protected $fillable = [
        'name'
    ];

    public function cellcodes()
    {
    	return $this->belongsToMany('App\Cellcode');
    }
}
