<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

    protected $primaryKey = 'order_id';

    public function taxonomy() {
    	return $this->hasMany('App\Taxonomy');
    }

    public function families() {
    	$families_id = Taxonomy::where('order_id',$this->order_id)->select('family_id')->get();
    	
    	return Family::whereIn('family_id', $families_id)->get();
    }
}
