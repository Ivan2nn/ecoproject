<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Cellcode;

class CellCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('basic.garage');
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
     * @param  string  $cellCodeName
     * @return \Illuminate\Http\Response
     */
    public function show($cellCodeName)
    {
        $cellCodeData = [];
        $selectedCellCode = Cellcode::where('cellname',$cellCodeName)->first();
        $cellCodeData['cellName'] = $selectedCellCode->cellname;
        $cellCodeData['regBio'] = $selectedCellCode->biogeographic_regions;
        $cellCodeData['species'] = $selectedCellCode->species;
        foreach ($cellCodeData['species'] as $temp) {
            $temp['classis'] = ($temp->taxonomy->tax_classis) ? $temp->taxonomy->tax_classis->class_name : '';
            $temp['family'] = ($temp->taxonomy->tax_family) ? $temp->taxonomy->tax_family->family_name : '';
            $temp['kingdom'] = ($temp->taxonomy->tax_kingdom) ? $temp->taxonomy->tax_kingdom->kingdom_name : '';
            $temp['order'] = ($temp->taxonomy->tax_order) ? $temp->taxonomy->tax_order->order_name : '';
            $temp['phylum'] = ($temp->taxonomy->tax_phylum) ? $temp->taxonomy->tax_phylum->phylum_name : '';
            $temp['genus'] = ($temp->taxonomy->tax_genus) ? $temp->taxonomy->tax_genus->genus_name : '';
        }
        return $cellCodeData;
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
}
