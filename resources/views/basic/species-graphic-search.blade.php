@extends('partials.layout')

@section('content')

   	
	<div class="row">
		<div class="col-md-5">
			<div class="ibox float-e-margins">
	            <div class="ibox-title">
	                <h4>Search By Name</h4>
	            </div>
	            <div class="ibox-content">
	                <form method="GET" action="/api/species/" v-ajax>
			            {!! csrf_field() !!}
						<div class="input-group">
							<input type="text"
							class="form-control"
			                v-model="query"
			                v-on:keyup="search"
			                v-on:click="resetQuery"
			            	>
			            @if ($species)
			            	<input type="hidden" v-model="outCode = '{!! $species->species_code !!}'">
			            	<input type="hidden" v-model="outSpeciesName = '{!! $species->species_name !!}'">
			            @endif
			            	<i v-show="loading" class="fa fa-spinner fa-spin"></i>
			            	<span class="input-group-btn">
			            	<button type="submit" class="btn btn-primary" v-show="searched[0].species_name == query"><strong>Search</strong></button>
			            	</span>
						</div>	
					</form>
				 	<species :list="searched"></species>
	            </div>
	            <div class="ibox float-e-margins i-box-mimi">
		            <div class="ibox-title">
		                <h4>Search By Code</h4>
		            </div>
		            <div class="ibox-content">
		                <h1 class="no-margins">386,200</h1>
		                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
		                <small>Total views</small>
		            </div>
		        </div>
	        </div>
	    </div>

			<!-- <form method="GET" action="/api/species/" v-ajax>
	            {!! csrf_field() !!}
				<div class="input-group">
					<input type="text"
					class="form-control"
	                v-model="query"
	                v-on:keyup="search"
	                v-on:click="resetQuery"
	            	>
	            @if ($species)
	            	<input type="hidden" v-model="outCode = '{!! $species->species_code !!}'">
	            	<input type="hidden" v-model="outSpeciesName = '{!! $species->species_name !!}'">
	            @endif
	            	<i v-show="loading" class="fa fa-spinner fa-spin"></i>
	            	<span class="input-group-btn">
	            	<button type="submit" class="btn btn-primary" v-show="searched[0].species_name == query"><strong>Search</strong></button>
	            	</span>
				</div>	
			</form>
		 	<species :list="searched"></species>
		</div> -->
		<div class="col-md-7">
            <div id="map" class="pull-right" style="width: 640px; height: 650px;"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="widget lazur-bg no-padding">
				<div class="p-m">
					<h2 class="font-bold">
		                @{{ speciesDetails.species_name }}
		            </h2>
		            <h2 class="font-bold">
						Cod DH: @{{ speciesDetails.species_code }}
					</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="widget lazur-bg no-padding">
				<div class="p-m">
					<h2>Taxonomy</h2>
				</div>
				<div class="p-m">
					<ul class="list-unstyled m-t-md">
						<li>
		                    <div class="pull-left"><h3>Kingdom:</h3></div>
		                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.kingdom }}</h4></div>
		                    <div class="clearfix"></div>   
		                </li>
		                <li>
		                    <div class="pull-left"><h3>Phylum:</h3></div>
		                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.phylum }}</h4></div>
		                    <div class="clearfix"></div>
		                </li>
		                <li>
		                    <div class="pull-left"><h3>Classis:</h3></div> 
		                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.classis }}</h4></div>
		                    <div class="clearfix"></div>
		                </li>
		                <li>
		                    <div class="pull-left"><h3>Order:</h3></div>
		                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.order }}</h4></div>
		                    <div class="clearfix"></div>
		                </li>
		                <li>
		                    <div class="pull-left"><h3>Family:</h3></div>
		                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.family }}</h4></div>
		                    <div class="clearfix"></div>
		                </li>
		                <li>
		                    <div class="pull-left"><h3>Genus:</h3></div>
		                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.genus }}</h4></div>
		                    <div class="clearfix"></div>			                    
		                </li>
		            </ul>
	            </div>
           </div>
           <div class="widget lazur-bg no-padding">
				<div class="p-m">
					<h2>Biogeographic Regions</h2>
				</div>
				<div class="p-m">
					<h4>@{{ speciesDetails.bioregions }}</h4>
				</div>
			</div>							
		</div>
		
		<div class="col-lg-4">
			<div class="widget lazur-bg no-padding">
				<div class="p-m">
					<h2>Conservations</h2>
				</div>
				<div class="p-m">
					<table class="table no-margins table-font-big">
						<thead>
							<tr>
								<th>ALP</th>
								<th>CON</th>
								<th>MED</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><div :class="itemStatusStyle(speciesDetails, 'alp')"></div></td>
								<td><div :class="itemStatusStyle(speciesDetails, 'con')"></div></td>
								<td><div :class="itemStatusStyle(speciesDetails, 'med')"></div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="widget lazur-bg no-padding">
				<div class="p-m">
					<h2>Trends</h2>
				</div>
				<div class="p-m">
					<table class="table no-margins table-font-big">
						<thead>
							<tr>
								<th>ALP</th>
								<th>CON</th>
								<th>MED</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><div :class="itemTrendStyle(speciesDetails, 'alp')"></div></td>
								<td><div :class="itemTrendStyle(speciesDetails, 'con')"></div></td>
								<td><div :class="itemTrendStyle(speciesDetails, 'med')"></div></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
	</div>

	<template id="species-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="spec in list" v-on:click="notify(spec)" style="cursor: default;">
                @{{ spec.species_name }} 
            </li>
        </ul>
    </template>

@endsection

@section('added-scripts')
	 <script src="{!! asset('js/speciesToCellMapping.js') !!}"></script>
     <script src="{!! asset('js/main.js') !!}"></script>
@endsection