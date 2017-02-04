<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function isInAnnexII() {
    	return DB::table('species_annex0712_ii')->where('species_code',$this->species_code)->first() != null;
    }

    public function isInAnnexIV() {
    	return DB::table('species_annex0712_iv')->where('species_code',$this->species_code)->first() != null;
    }

    public function isInAnnexV() {
    	return DB::table('species_annex0712_v')->where('species_code',$this->species_code)->first() != null;
    }

    public function annexList() {
    	$finalList = '';
    	if ($this->isInAnnexII())
    		$finalList = $finalList . 'II - ';
    	if ($this->isInAnnexIV())
    		$finaList = $finalList . 'IV - ';
    	if ($this->isInAnnexV())
    		$finaList = $finalList . 'V';

    	return $finalList;
    }

    // Better to have list of the annexes as an array
    public function annexes() 
    {
    	$finalList = [];
    	if ($this->isInAnnexII())
    		array_push($finalList, 'II');
    	if ($this->isInAnnexIV())
    		array_push($finalList, 'IV');
    	if ($this->isInAnnexV())
    		array_push($finalList, 'V');

    	return $finalList;
    }

    // This section is about the modified Species... at the moment the system is not optimized so se must base the search on the table itself

    public function handleTheCode()
    {
    	$connected_species = collect([]);

    	switch ($this->modified_code)
    	{
    		case 'NN':
    			$connected_species['type_of_modification'] = 'NN';
    			$connected_species['text_of_modification'] = 'Specie a cui è stato modificato il nome';
    			$connected_species['species'] = Species::where('species_code',$this->reported_species_code)->get();
    		break;

    		case 'SP':
    			$connected_species['type_of_modification'] = 'SP';
    			if ($this->reported_species_code == '')
    			{
    				$connected_species['text_of_modification'] = 'Specie che è stata splittata';
    				$connected_species['species'] = Species::where('reported_species_code', $this->species_code)->get();
    			}
    			else
    			{
    				$connected_species['text_of_modification'] = 'Specie derivata dallo split di un originale';
    				$connected_species['species'] = Species::where('species_code', $this->reported_species_code)->get();
    			}

    			
    		break;

    		case 'CO':
    			$connected_species['type_of_modification'] = 'CO';
    			$connected_species['text_of_modification'] = 'Specie diventata complex';
    			$connected_species['species'] = Species::where('species_code',$this->reported_species_code)->get();
    		break;

    		case 'AD':
    			$connected_species['type_of_modification'] = 'AD';
    			$connected_species['text_of_modification'] = 'Specie aggiunta successivamente';
    			$connected_species['species'] = Species::where('species_code',$this->reported_species_code)->get();
    		break;

    		default:

    	}

    	return $connected_species;
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
