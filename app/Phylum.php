<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phylum extends Model
{
	protected $table = 'phylums';

    protected $primaryKey = 'phylum_id';

    public function taxonomies() {
    	return $this->hasMany('App\Taxonomy');
    }

    public function classes() {
    	$classes_id = Taxonomy::where('phylum_id',$this->phylum_id)->select('class_id')->get();
    	
    	return Classis::whereIn('class_id', $classes_id)->get();
    }
}
