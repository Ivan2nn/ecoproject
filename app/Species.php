<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
	protected $table = 'species_report0712';

	protected $primaryKey = 'species_code';

    protected $fillable = ['species_name'];

    public function taxonomy() {
    	return $this->hasOne('App\Taxonomy','species_code');
    }

    public function cellcodes()
    {
    	return $this->belongsToMany('App\Cellcode','cellcode_species','species_code','cellcode_id');
    }

    public function biogeographicregions() {
    	$tmpBioReg = array();
    	foreach ($this->cellcodes as $cc) {
    		foreach ($cc->biogeographicregions as $bioreg) {
    			if (!in_array($bioreg->name, $tmpBioReg)) {
    				$tmpBioReg[] = $bioreg->name;
    			}
    		}
    	}
    	return $tmpBioReg;
    }

}
