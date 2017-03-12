<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Habitat;

class HabitatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('basic.habitat-graphic-search');
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
    public function show($habitat_code)
    {
        $selectedHabitat = Habitat::find($habitat_code);
        /* We have to retrieve also other informations */
        $tempCellCodes = $selectedHabitat->cellcodes;
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

        $outputData['habitat']['habitat_name'] = $selectedHabitat->habitat_name;
        $outputData['habitat']['habitat_code'] = $selectedHabitat->habitat_code;
        $outputData['habitat']['macrocategory'] = $selectedHabitat->macrocategory->habitat_macrocategory_name;
        $outputData['habitat']['habitat_conservation_alp'] = $selectedHabitat->getFormattedConservation("ALP");
        $outputData['habitat']['habitat_conservation_con'] = $selectedHabitat->getFormattedConservation("CON");
        $outputData['habitat']['habitat_conservation_med'] = $selectedHabitat->getFormattedConservation("MED");
        $outputData['habitat']['habitat_trend_alp'] = $selectedHabitat->getFormattedTrend("ALP");
        $outputData['habitat']['habitat_trend_con'] = $selectedHabitat->getFormattedTrend("CON");
        $outputData['habitat']['habitat_trend_med'] = $selectedHabitat->getFormattedTrend("MED");
        $outputData['habitat']['bioregions'] = $selectedHabitat->biogeographicregions->pluck('name')->toArray();
        
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

    public function getHabitatGeoJson($tempCellCodes) {
        
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
