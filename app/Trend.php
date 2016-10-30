<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
	protected $primaryKey = 'trend_code';

    protected $fillable = ['trend_name'];
}
