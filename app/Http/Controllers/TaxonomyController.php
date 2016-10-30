<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TaxonomyController extends Controller
{
    public function kingdom_index() {
    	$kingdoms = App\Kingdom::all();

    	return json_encode($kingdoms);
    }

    public function kingdom_show($id) {
    	$kingdom = App\Kingdom::find($id);

    	return json_encode($kingdom);
    }

    public function kingdom_species($id) {
    	$taxonomies = App\Taxonomy::where('kingdom_id',$id)->get();

    	return json_encode($this->getSpeciesInfo($species));
    }

    public function phylum_index() {
    	$phyla = App\Phylum::all();

    	return json_encode($phyla);
    }

    public function phylum_show($id) {
    	$phylum = App\Phylum::find($id);

    	return json_encode($phylum);
    }

    public function phylum_species($id) {
    	$taxonomies = App\Taxonomy::where('phylum_id, $id')->get();

    	return json_encode($this->getSpeciesInfo($taxonomies));
    }

    public function getSpeciesInfo($taxonomies) {
    	$species = App\Species::find($taxonomies->species_code);
    	$speciesInfo = $species->map($item, $key) {
    		return [
    			'species_code' 	=> $item->species_code,
    			'species_name' 	=> $item->species_name,
    			'kingdom_name' 	=> $item->hasKingdom ? $item->tax_kingdom->kingdom_name : '',
    			'phylum_name'	=> $item->hasPhylum ? $item->tax_phylum->phylum_name : '',
    			'class_name'	=> $item->hasClassis ? $item->tax_classis->class_name : '',
    			'order_name'	=> $item->hasOrder ? $item->tax_order->order_name : '',
    			'family_name'	=> $item->hasFamily ? $item->tax_family->family_name : '',
    			'genus_name'	=> $item->hasGenus ? $item->tax_genus->genus_name : '',
    			'bioregions'	=> $item->biogeographicregions()
    		];
    	}
    }
}
