@extends('partials.layout')

@section('content')
<div class="c-content-box c-size-md c-bg-white">
  <div class="container">
   	<div class="row">
      <div class="col-md-5">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <div class="row">
              <div class="col-sm-8">
                  <h4 class="input-font-mimi-big">Search By Cellcode</h4>
              </div>
              <div class="col-sm-4">
                <div class="sk-spinner sk-spinner-chasing-dots pull-right" v-if="loadingNames">
                    <div class="sk-dot1"></div>
                    <div class="sk-dot2"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="ibox-content">
            <form methd="GET" action="/cellcodes/species/" v-ajax>
              {!! csrf_field() !!}
              <div class="row">
                <div class="col-sm-8 has-success">
                  <input type="text"
                    class="form-control"
                    v-model="selectedCell"
                    id="cellCodeSelectionBox" />
                </div>
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-primary btn-lg pull-right"><strong>Search</strong></button>
                </div>
              </div>  
            </form>

          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <div class="row">
              <div class="col-sm-12">
                  <h4 class="input-font-mimi-big">Species Map</h4>
              </div>
            </div>
          </div>
          <div class="ibox-content">
            <div id="map" style="width: 620px; height: 650px;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <multi-species-info-cell :list="speciesDetails"></multi-species-info-cell>
    </div>
  </div>
</div>
</div>

<template id="multi-species-info-cell-template">
  <table class="table table-hover table-fixed">
    <thead>
      <tr>
          <th rowspan="2" class="mimi-table-cell-font">Code</th>
          <th rowspan="2" class="mimi-table-cell-font">Name</th>
          <th colspan="3" class="mimi-table-cell-font">Status</th>
          <th colspan="3" class="mimi-table-cell-font">Trend</th>
          <th rowspan="2" class="mimi-table-cell-font">Region</th>
          <th rowspan="2" class="mimi-table-cell-font">Annexes</th>
          <th rowspan="2" class="mimi-table-cell-font">Taxonomy</th>
      </tr>
      <tr>
          <th>ALP</th>
          <th>CON</th>
          <th>MED</th>
          <th>ALP</th>
          <th>CON</th>
          <th>MED</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="spec in list">
        <td class="mimi-table-cell-font"><a v-bind:href=" '/species-basic-search/'+spec.species_code" target="_blank" >@{{ spec.species_code }}</a></td>
        <td class="mimi-table-cell-font">@{{ spec.species_name }}</td>
        <td><div v-bind:class="itemStatusStyle(spec, 'alp')"></div></td>
        <td><div v-bind:class="itemStatusStyle(spec, 'con')"></div></td>
        <td><div v-bind:class="itemStatusStyle(spec, 'med')"></div></td>
        <td><div><span><img v-bind:src="itemTrendStyle(spec, 'alp')" class="trend-image" /></span></div></td>
        <td><div><span><img v-bind:src="itemTrendStyle(spec, 'con')" class="trend-image" /></span></div></td>
        <td><div><span><img v-bind:src="itemTrendStyle(spec, 'med')" class="trend-image" /></span></div></td>
        <td>
            <div v-for="bioreg in spec.bioregions" class="mimi-table-cell-font">@{{ bioreg }}</div>
        </td>
        <td>
            <div v-for="annex in spec.annexes" class="mimi-table-cell-font">@{{ annex }}</div>
        </td>
        <td>
            <div><img src="{!! asset('images/kingdom_vlittle.png') !!}" /> @{{ spec.kingdom_name }}</div>
            <div><img src="{!! asset('images/phylum_vlittle.png') !!}" /> @{{ spec.phylum_name }}</div>
            <div><img src="{!! asset('images/class_vlittle.png') !!}" /> @{{ spec.class_name }}</div> 
            <div><img src="{!! asset('images/order_vlittle.png') !!}" /> @{{ spec.order_name }}</div>
            <div><img src="{!! asset('images/family_vlittle.png') !!}" /> @{{ spec.family_name }}</div>
            <div><img src="{!! asset('images/genus_vlittle.png') !!}" /> @{{ spec.genus_name }}</div>
        </td>
      </tr>
    </tbody>
  </table>          
</template>

@endsection

@section('added-scripts')
	<script src="{!! asset('js/cellToSpeciesMapping.js') !!}"></script>
  <script src="{!! asset('js/main_cells_to_species.js') !!}"></script>
@endsection