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
			<div class="col-sm-4">
			<form methd="GET" action="/api/cellcodes/" v-ajax>
                {!! csrf_field() !!}
				<div class="input-group">
					<input type="text"
					class="form-control"
                    v-model="selectedCell"
                    id="cellCodeSelectionBox"
                	>
                	<i  v-show="loading" class="fa fa-spinner fa-spin"></i>
                	<span class="input-group-btn">
                	<button type="submit" class="btn btn-primary"><strong>Search</strong></button>
                	</span>
				</div>	
			</form>
			
			</div>
			<div class="col-sm-8">
                <div id="map" style="width: 640px; height: 650px;"></div>
			</div>
		</div>
		<div class="row">
			<info-cell :list="species"></info-cell>
		</div>
	</div>

	<template id="info-cell-template">
            <h4>@{{ selectedCell->cellName }}</h4>
            <h4>Biogeographic Region: @{{ selectedCell->biogegraphic_regions[0]->name }}</h4>
            <table class="table table-hover">
              <thead>
                <tr>
					<th>Scientific Name</th>
					<th>Status</th>
                  	<th>Trend</th>
                  	<th>Family</th>
                  	<th>Kingdom</th>
                  	<th>Order</th>
                  	<th>Phylum</th>
                  	<th>Class</th>
                  	<th>Genus</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="spec in list">
                  <td>@{{ spec.name }} </td>
                  <td>Status</td>
                  <td>Trend</td>
                  <td>@{{ spec.family }}</td>
                  <td>@{{ spec.kingdom }}</td>
                  <td>@{{ spec.order }}</td>
                  <td>@{{ spec.phylum }}</td>
                  <td>@{{ spec.classis }}</td>
                  <td>@{{ spec.genus }}</td>
                </tr>
              </tbody>
            </table>
        </template>

@endsection

@section('added-scripts')
	 <script src="{!! asset('js/cellToSpeciesMapping.js') !!}"></script>
     <script src="{!! asset('js/mainCellToSpecies.js') !!}"></script>
@endsection