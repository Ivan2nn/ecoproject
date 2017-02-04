<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Biogeographicregion;
use App\Species;
use App\Taxonomy;

class BiogeographicregionController extends Controller
{
    public function getSpeciesFromBiogeographicRegion(Request $request)
    {
    	$list_of_chosen_regbio = $request->get('regbio_checks');

    	$chosen_regbio = collect();
    	$counter = 0;

    	foreach ($list_of_chosen_regbio as $key => $value)
    	{ 
    		if ($value == 'true') 
    		{
    			$counter = $counter + 1;

    			$temp_reg = Biogeographicregion::where('name',$key)->first();
    			
    			if ($counter == 1)
    			{
    				$chosen_regbio = $temp_reg->species;
    			}
    			else 
    			{
    				$chosen_regbio = $chosen_regbio->merge($temp_reg->species);
    			}
    		}
    	}

    	$final_species = $this->get_species_info($chosen_regbio)->unique('species_name');
    	$final_species_sorted = $final_species->sortBy('species_name');
    	
    	return json_encode($final_species_sorted->values()->all());
    }


	public function get_species_info($species_list) {
		$species_info = [];
		$species_info = $species_list->map(function($item, $key) {
			$species = Species::find($item->species_code);
			// ERROR :: If the original database of the species would be full even with duplicate species this could be taken out
			if ($species && $species->taxonomy) {

				return [
					'species_code' => $species->species_code,
					'species_name' => $species->species_name,
	                'species_conservation_alp' => $species->getFormattedConservation("ALP"),
	                'species_conservation_con' => $species->getFormattedConservation("CON"),
	                'species_conservation_med' => $species->getFormattedConservation("MED"),
	                'species_trend_alp' => $species->getFormattedTrend("ALP"),
	                'species_trend_con' => $species->getFormattedTrend("CON"),
	                'species_trend_med' => $species->getFormattedTrend("MED"),
					'class_name' => $species->taxonomy->tax_classis ? $species->taxonomy->tax_classis->class_name : ' ',
					'family_name' => $species->taxonomy->tax_family ? $species->taxonomy->tax_family->family_name : ' ',
					'kingdom_name' => $species->taxonomy->tax_kingdom ? $species->taxonomy->tax_kingdom->kingdom_name : ' ',
					'order_name' => $species->taxonomy->tax_order ? $species->taxonomy->tax_order->order_name : ' ',
					'phylum_name' => $species->taxonomy->tax_phylum ? $species->taxonomy->tax_phylum->phylum_name : ' ',
					'genus_name' => $species->taxonomy->tax_genus ? $species->taxonomy->tax_genus->genus_name : ' ',
					'bioregions' => $species->biogeographicregions->pluck('name')->toArray(),
					'annexes' => $species->annexes()
				];
			}
		});

		return $species_info;
	}
}