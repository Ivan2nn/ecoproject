@extends('partials.layout')

@section('added-styles')
  
    <link href="{!! asset('css/vendor/switchery.css') !!}" media="all" rel="stylesheet" type="text/css" />
   
@endsection

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <div class="row">
            <div class="col-sm-8">
                <h4 class="input-font-mimi-big">Ricerca Avanzata</h4>
            </div>
            <div class="col-sm-4">
              <div class="sk-spinner sk-spinner-chasing-dots pull-right" v-if="loadingNames">
                  <div class="sk-dot1"></div>
                  <div class="sk-dot2"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="ibox-content col-sm-12">
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <form method="GET" action="macrocategoriestohabitat" @submit.prevent="searchHabitatsFromMacrocategory">
                  {!! csrf_field() !!}
                <div class="row">
                	@foreach ($macrocategories as $macrocategory)
                  	<div class="col-sm-12">
                    	<h2>{!! $macrocategory->habitat_macrocategory_name !!}</h2>
                    	<input class="js-switch-mac{!! $macrocategory->habitat_macrocategory_id !!}" type="checkbox" data-switchery="true" />
                  	</div>
                  	@endforeach
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group">
                      
                      <button type="submit" id="macrocategory_submit" class="btn btn-primary" v-show="true"><strong>Search</strong></button>         
                    </div>  
                  </div>
                </div>
              </form>
            </div>

            <div class="col-sm-12 col-md-4">

              <form method="GET" action="biogeographicregtohabitat" @submit.prevent="searchHabitatsFromBioreg">
                  {!! csrf_field() !!}
                <div class="row">
                  <div class="col-sm-12">
                    <h2>ALP</h2>
                    <input class="js-switch-alp" type="checkbox" data-switchery="true" />
                    
                  </div>
                  <div class="col-sm-12">
                    <h2>CON</h2>
                    <input class="js-switch-con" type="checkbox" />
                    
                  </div>
                  <div class="col-sm-12">
                    <h2>MED</h2>
                    <input class="js-switch-med" type="checkbox" />
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group">
                      
                      <button type="submit" id="regbio_submit" class="btn btn-primary" v-show="true"><strong>Search</strong></button>         
                    </div>  
                  </div>
                </div>
              </form>

            </div>

            <div class="col-sm-12 col-md-4">
              <form method="GET" action="conservationstatetohabitat" @submit.prevent="searchHabitatsFromConservationStatus">
                  {!! csrf_field() !!}
                  <div class="row">
                  <div class="col-sm-12">
                    <h2>FV</h2>
                    <input class="js-switch-status-fv" type="checkbox" />
                    
                  </div>
                  <div class="col-sm-12">
                    <h2>U1</h2>
                    <input class="js-switch-status-u1" type="checkbox" />
                    
                  </div>
                  <div class="col-sm-12">
                    <h2>U2</h2>
                    <input class="js-switch-status-u2" type="checkbox" />
                    
                  </div>
                  <div class="col-sm-12">
                    <h2>XX</h2>
                    <input class="js-switch-status-xx" type="checkbox" />
                    
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group">
                      
                      <button type="submit" id="status_conserve_submit" class="btn btn-primary" v-show="true"><strong>Search</strong></button>         
                    </div>  
                  </div>
                </div>
              </form>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

	<div class="row">
		<multi-habitat-info-cell :list="habitatDetails"></multi-habitat-info-cell>
	</div>

	<template id="habitat-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="spec in list" v-on:click="notify(spec)" style="cursor: default;">
                @{{ hab.habitat_name }} 
            </li>
        </ul>
    </template>

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
   <script src="{!! asset('js/vendor/switchery.js') !!}"></script>
	 <script src="{!! asset('js/macrocategory_regbio_status_to_habitat.js') !!}"></script>
   <script src="{!! asset('js/macrocategory_main.js') !!}"></script>
   
@endsection