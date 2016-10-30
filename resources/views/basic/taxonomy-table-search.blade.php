@extends('partials.layout')

@section('content')

   	<div class="row">
	    <div class="col-lg-12">
	        <div class="text-center">
	            <h1>
	                Search By Species
	            </h1>
	            <small>
	                From here the user will be able to perform a real-time search for the species; the map will show in which cells the selected species is present
	            </small>
	        </div>
	    </div>
	</div>
	<div class="p-w-md m-t-sm">
		<div class="row">
			<div class="col-sm-12">
			<form method="GET" action="api/taxonomy-to-species/" v-ajax>
                {!! csrf_field() !!}

        <!-- <div class="form-group">
          <label for="selectKingdom" style="min-width: 100px;">Select Kingdom</label>
          <select v-model="selectedKingdom" id="selectKingdom" style="min-width: 200px;">
            <option v-for="kingdom in kingdoms" v-bind:value="kingdom.kingdom_id">
              @{{ kingdom.kingdom_name }}
            </option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="selectPhylum" style="min-width: 100px;">Select Phylum</label>
          <select v-model="selectedPhylum" id="selectPhylum" style="min-width: 200px;">
            <option v-for="phylum in phyla" v-bind:value="phylum.phylum_id">
              @{{ phylum.phylum_name }}
              </option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="selectClassis" style="min-width: 100px;">Select Class</label>
          <select v-model="selectedClassis" id="selectClassis" style="min-width: 200px;">
            <option v-for="classis in classes" v-bind:value="classis.class_id">
              @{{ classis.class_name }}
            </option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="selectOrder" style="min-width: 100px;">Select Order</label>
          <select v-model="selectedOrder" id="selectOrder" style="min-width: 200px;">
            <option v-for="order in orders" v-bind:value="order.order_id">
            @{{ order.order_name }}
              </option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="selectFamily" style="min-width: 100px;">Select Family</label>
          <select v-model="selectedFamily" id="selectFamily" style="min-width: 200px;">
            <option v-for="family in families" v-bind:value="family.family_id">
            @{{ family.family_name }}
            </option>
          </select>
        </div> -->
          
        
        <!-- <select v-model="selectedGenus" multiple>
          <option v-for="genus in genera" v-bind:value="genus.genus_id">
          @{{ genus.genus_name }}
        </select>
        <br>
        <span>Selected Genus: @{{ selectedGenus }}</span> -->
        @foreach($kingdoms as $kingdom)
        <div class="panel-group col-sm-2" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="{{ '#' . $kingdom->kingdom_name . '-collapse' }}">
                  </span>{{ $kingdom->kingdom_name}}</a>
              </h4>
            </div>
            <div id="{{ $kingdom->kingdom_name . '-collapse' }}" class="panel-collapse collapse in">
              <div id="{{ $kingdom->kingdom_name . '_jstree' }}">
                <ul>
                @foreach($kingdom->phyla() as $phylum)
                  <li>{{ $phylum->phylum_name }}
                    <ul>
                    @foreach($phylum->classes() as $class)
                      <li>{{ $class->class_name }}
                        <ul>
                        @foreach($class->orders() as $order)
                        <li>{{ $order->order_name }}
                          <ul>
                          @foreach($order->families() as $family)
                          <li>{{ $family->family_name }}
                          </li>
                          @endforeach
                          </ul>
                        </li>
                        @endforeach
                        </ul>
                      </li>
                    @endforeach
                    </ul>
                  </li>
                @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endforeach
				
        <div class="input-group">
					
        	<button type="submit" class="btn btn-primary" v-show="true"><strong>Search</strong></button>         
				</div>	
			</form>
			</div>
			
		</div>
	</div>

  <vuetable
            api-url="{{ url('api/taxonomy-to-species/k1:p3:c5:o22:f10:g15') }}"
            :fields="columns"
        >      
  </vuetable>

	<div class="row">
		<multi-species-info-cell :list="speciesDetails"></multi-species-info-cell>
	</div>

	<template id="species-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="spec in list" v-on:click="notify(spec)" style="cursor: default;">
                @{{ spec.species_name }} 
            </li>
        </ul>
    </template>

    <template id="multi-species-info-cell-template">
        <table class="table table-hover">
          <thead>
            <tr>
                <th>Scientific Code</th>
          			<th>Scientific Name</th>
          			<th>Status</th>
              	<th>Trend</th>
              	<th>Biogeographic Region</th>
              	<th>Kingdom</th>
              	<th>Phylum</th>
              	<th>Class</th>
              	<th>Order</th>
              	<th>Family</th>
              	<th>Genus</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="spec in list">
              <td>@{{ spec.species_code }}</td>
              <td>@{{ spec.species_name }}</td>
              <td>Status</td>
              <td>Trend</td>
              <td>@{{ spec.bioregions }}</td>
              <td>@{{ spec.kingdom_name }}</td>
              <td>@{{ spec.phylum_name }}</td>
              <td>@{{ spec.class_name }}</td>
              <td>@{{ spec.order_name  }}</td>
              <td>@{{ spec.family_name  }}</td>
              <td>@{{ spec.genus_name }}</td>
            </tr>
          </tbody>
        </table>
    </template>

@endsection

@section('added-scripts')
	 <script src="{!! asset('js/taxonomyToSpecies.js') !!}"></script>
   <script src="{!! asset('js/taxonomy_main.js') !!}"></script>
   <script type="text/javascript" src="http://cdn.jsdelivr.net/vue.table/1.5.3/vue-table.min.js"></script>
@endsection