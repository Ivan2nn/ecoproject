@extends('partials.layout')

@section('content')

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
            <form methd="GET" action="/cellcodes/habitat/" v-ajax>
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
                  <h4 class="input-font-mimi-big">Habitat Map</h4>
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
    <multi-habitat-info-cell :list="habitatDetails"></multi-habitat-info-cell>
  </div>

	<template id="multi-habitat-info-cell-template">
    <table class="table table-hover table-fixed">
      <thead>
        <tr>
            <th rowspan="2" class="mimi-table-cell-font">Code</th>
            <th rowspan="2" class="mimi-table-cell-font">Name</th>
            <th colspan="3" class="mimi-table-cell-font">Status</th>
            <th colspan="3" class="mimi-table-cell-font">Trend</th>
            <th rowspan="2" class="mimi-table-cell-font">Region</th>
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
        <tr v-for="hab in list">
          <td class="mimi-table-cell-font"><a v-bind:href=" '/habitat-basic-search/'+hab.habitat_code" target="_blank" >@{{ hab.habitat_code }}</a></td>
          <td class="mimi-table-cell-font">@{{ hab.habitat_name }}</td>
          <td><div v-bind:class="itemStatusStyle(hab, 'alp')"></div></td>
          <td><div v-bind:class="itemStatusStyle(hab, 'con')"></div></td>
          <td><div v-bind:class="itemStatusStyle(hab, 'med')"></div></td>
          <td><div><span><img v-bind:src="itemTrendStyle(hab, 'alp')" class="trend-image" /></span></div></td>
          <td><div><span><img v-bind:src="itemTrendStyle(hab, 'con')" class="trend-image" /></span></div></td>
          <td><div><span><img v-bind:src="itemTrendStyle(hab, 'med')" class="trend-image" /></span></div></td>
          <td>
              <div v-for="bioreg in hab.bioregions" class="mimi-table-cell-font">@{{ bioreg }}</div>
          </td>
        </tr>
      </tbody>
    </table>          
  </template>

@endsection

@section('added-scripts')
	<script src="{!! asset('js/cellToSpeciesMapping.js') !!}"></script>
  <script src="{!! asset('js/main_cells_to_habitats.js') !!}"></script>
@endsection