<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
	protected $table = 'families';

    protected $primaryKey = 'family_id';

    public function taxonomy() {
    	return $this->hasMany('App\Taxonomy');
    }
}
