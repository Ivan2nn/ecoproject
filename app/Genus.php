<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genus extends Model
{
	protected $table = 'genera';

    protected $primaryKey = 'genus_id';

    public function taxonomy() {
    	return $this->hasMany('App\Taxonomy');
    }
}
