<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Species;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Species::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($species_code)
    {
        $selectedSpecies = Species::find($species_code);
        /* We have to retrieve also other informations */
        $tempCellCodes = $selectedSpecies->cellcodes;
        $outputData = array('type'=>'FeatureCollection');
        $contentCell = file_get_contents(public_path() . '/json/griglia.json');
        $json_a = json_decode($contentCell, true);
        $ind = 0;

        foreach ($tempCellCodes as $sampleCellCode) {
            foreach ($json_a['features'] as $key => $value) {
                if ($sampleCellCode->cellname == $value['properties']['CellCode']) {
                    $outputData['features'][$ind] = $value;
                    $ind++;
                }
            }
        }

        $outputData['species']['classis'] = ($selectedSpecies->taxonomy->tax_classis) ? $selectedSpecies->taxonomy->tax_classis->class_name : '';
        $outputData['species']['family'] = ($selectedSpecies->taxonomy->tax_family) ? $selectedSpecies->taxonomy->tax_family->family_name : '';
        $outputData['species']['kingdom'] = ($selectedSpecies->taxonomy->tax_kingdom) ? $selectedSpecies->taxonomy->tax_kingdom->kingdom_name : '';
        $outputData['species']['order'] = ($selectedSpecies->taxonomy->tax_order) ? $selectedSpecies->taxonomy->tax_order->order_name : '';
        $outputData['species']['phylum'] = ($selectedSpecies->taxonomy->tax_phylum) ? $selectedSpecies->taxonomy->tax_phylum->phylum_name : '';
        $outputData['species']['genus'] = ($selectedSpecies->taxonomy->tax_genus) ? $selectedSpecies->taxonomy->tax_genus->genus_name : '';
        $outputData['species']['bioregions'] = $selectedSpecies->biogeographicregions();
        
        return json_encode($outputData);
     }


     public function multipleShow($speciesCodes) 
     {
        $pieces = explode(',',$speciesCodes);
        $outputData = [];

        foreach ($pieces as $piece) {
            $selectedSpecies = Species::find($piece);
            $outputData[$piece]['name'] = $selectedSpecies->species_name;
            $outputData[$piece]['classis'] = ($selectedSpecies->taxonomy->tax_classis) ? $selectedSpecies->taxonomy->tax_classis->class_name : '';
            $outputData[$piece]['family'] = ($selectedSpecies->taxonomy->tax_family) ? $selectedSpecies->taxonomy->tax_family->family_name : '';
            $outputData[$piece]['kingdom'] = ($selectedSpecies->taxonomy->tax_kingdom) ? $selectedSpecies->taxonomy->tax_kingdom->kingdom_name : '';
            $outputData[$piece]['order'] = ($selectedSpecies->taxonomy->tax_order) ? $selectedSpecies->taxonomy->tax_order->order_name : '';
            $outputData[$piece]['phylum'] = ($selectedSpecies->taxonomy->tax_phylum) ? $selectedSpecies->taxonomy->tax_phylum->phylum_name : '';
            $outputData[$piece]['genus'] = ($selectedSpecies->taxonomy->tax_genus) ? $selectedSpecies->taxonomy->tax_genus->genus_name : '';
            $outputData[$piece]['bioregions'] = $selectedSpecies->biogeographicregions();
        }

        return json_encode($outputData);
        
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSpeciesGeoJson($tempCellCodes) {
        
        $outputData = array('type'=>'FeatureCollection');
        $contentCell = file_get_contents(public_path() . '/json/griglia.json');
        $json_a = json_decode($contentCell, true);
        $ind = 0;
        foreach ($sampleCellCodes as $tempCellCodes) {
            foreach ($json_a['features'] as $key => $value) {
                if ($sampleCellCode == $value['properties']['CellCode']) {
                    $outputData['features'][$ind] = $value;
                    $ind++;
                }
            }
        }
        return json_encode($outputData);
    }
}
