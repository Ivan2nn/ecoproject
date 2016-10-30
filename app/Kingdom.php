<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kingdom extends Model
{
	protected $table = 'kingdoms';

    protected $primaryKey = 'kingdom_id';

    public function taxonomy() {
    	return $this->hasMany('App\Taxonomy');
    }

    public function phyla() {
    	$phyla_id = Taxonomy::where('kingdom_id',$this->kingdom_id)->select('phylum_id')->get();
    	
    	return Phylum::whereIn('phylum_id', $phyla_id)->get();
    }
}
