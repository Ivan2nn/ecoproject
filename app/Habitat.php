<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitat extends Model
{
    protected $table = 'habitat';

	protected $primaryKey = 'habitat_code';

	public function macrocategory() {
		return $this->belongsTo('App\Macrocategory','habitat_macrocategory_id','habitat_macrocategory_id');
	}

	public function cellcodes()
    {
    	return $this->belongsToMany('App\Cellcode','cellcode_habitat','habitat_code','cellcode_id');
    }

    public function biogeographicregions() 
    {
        return $this->belongsToMany('App\Biogeographicregion','habitat_data0712_status_conserve','habitat_code','biogeographicregion_id');
    }

    public function conservations()
    {
        return $this->belongsToMany('App\Conservation','habitat_data0712_status_conserve','habitat_code','status_conserve_id')->withPivot('biogeographicregion_id');
    }

    public function trends()
    {
        return $this->belongsToMany('App\Trend','habitat_data0712_trend','habitat_code','trend_id')->withPivot('biogeographicregion_id');
    }

    public function getFormattedConservation($bioreg)
    {
        $specificBioregionConservation = $this->conservations->filter(function($item, $key) use($bioreg){
        	return Biogeographicregion::where('id', $item->pivot->biogeographicregion_id)->first()->name == $bioreg;
        });

        if ($specificBioregionConservation->count() > 0) {
        	return $specificBioregionConservation->first()->code;
        } else {
        	return '';
        }
    }

    public function getFormattedTrend($bioreg)
    {
        $specificBioregionTrend = $this->trends->filter(function($item, $key) use($bioreg){
        	return Biogeographicregion::where('id',$item->pivot->biogeographicregion_id)->first()->name == $bioreg;
        });

        if ($specificBioregionTrend->count() > 0) {
        	return $specificBioregionTrend->first()->code;
        } else {
        	return '';
        }
    }
}
