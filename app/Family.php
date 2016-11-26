<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
	protected $table = 'tax_14families';

    protected $primaryKey = 'family_code';

    public function taxonomy() {
    	return $this->hasMany('App\Taxonomy');
    }
}
