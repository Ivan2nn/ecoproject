<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
	protected $table = 'species';

	protected $primaryKey = 'species_code';

    protected $fillable = ['species_name'];

    public function taxonomy() {
    	return $this->hasOne('App\Taxonomy','species_code');
    }

    public function cellcodes()
    {
    	return $this->belongsToMany('App\Cellcode','cellcode_species','species_code','cellcode_id');
    }

    public function biogeographicregions() 
    {
        return $this->belongsToMany('App\Biogeographicregion','species_data0712_status_conserve','species_code','biogeographicregion_id');
    }

    public function presences()
    {
        return $this->belongsToMany('App\Presence','species_data0712_presence','species_code','status_presence_id')->withPivot('biogeographicregion_id');
    }

    public function conservations()
    {
        return $this->belongsToMany('App\Conservation','species_data0712_status_conserve','species_code','status_conserve_id')->withPivot('biogeographicregion_id');
    }

    public function trends()
    {
        return $this->belongsToMany('App\Trend','species_data0712_trend','species_code','trend_id')->withPivot('biogeographicregion_id');
    }

    // This method gives back a formatted array with the values REGBIO[STATUS_PRESERVE]
    public function getFormattedPresences()
    {
        $allPresences = $this->presences->map(function($item, $key){
            return [
                Biogeographicregion::where('id',$item->pivot->biogeographicregion_id)->first()->name . '[' . $item->name . ']',
            ];
        });

        return $allPresences;
    }

    public function getFormattedConservations()
    {
        $allConservations = $this->conservations->map(function($item, $key){
            return [
                Biogeographicregion::where('id', $item->pivot->biogeographicregion_id)->first()->name . '[' . $item->code . ']',
            ];
        });

        return $allConservations;
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

    public function getFormattedTrends()
    {
        $allTrends = $this->trends->map(function($item, $key){
            return [
                Biogeographicregion::where('id',$item->pivot->biogeographicregion_id)->first()->name . '[' . $item->name . ']',
            ];
        });

        return $allTrends;
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

    // This is the old version before using the status_preserve table. Actually we could use a biogeographcregions_species table apart
    /*public function biogeographicregions() {
    	foreach ($this->cellcodes as $cc) {
            $cc->biogeographicregions->unique();
    		foreach ($cc->biogeographicregions as $bioreg) {
    			if (!in_array($bioreg->name, $tmpBioReg)) {
    				$tmpBioReg[] = $bioreg->name;
    			}
    		}
    	}
    	return $tmpBioReg;
    }*/

}
