<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classis extends Model
{
	protected $table = 'classes';

	protected $primaryKey = 'class_id';

    public function taxonomy() {
    	return $this->hasMany('App\Taxonomy');
    }

    public function orders() {
    	$orders_id = Taxonomy::where('class_id',$this->class_id)->select('order_id')->get();
    	
    	return Order::whereIn('order_id', $orders_id)->get();
    }
}
