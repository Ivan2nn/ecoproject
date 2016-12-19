@extends('partials.layout')

@section('content')

   	
	<div class="row">
		<div class="col-md-5">
			<div class="ibox float-e-margins">
	            <div class="ibox-title">
	            	<div class="row">
	            		<div class="col-sm-8">
	                		<h4 class="input-font-mimi-big">Search By Name</h4>
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
	                <form method="GET" action="/api/species/" v-ajax>
				            {!! csrf_field() !!}
    	            	<div class="row">	
				            <div class="col-sm-8 has-success">
								<input type="text"
								class="form-control input-lg input-font-mimi-normal"
				                v-model="queryName"
				                v-on:keyup="searchNames"
				                v-on:click="resetQueries"
				            	>
							</div>
							<div class="col-sm-4">
				            	<button type="submit" class="btn btn-primary btn-lg pull-right" v-show="searchingNames"><strong>Search</strong></button>
				            </div>
		            	</div>
					</form>
					<div class="row" v-if="!isSearching">
						<div class="col-sm-8">
				 			<species-names :list="searchedNames"></species-names>
				 		</div>
				 	</div>
	            </div>
	        </div>
            <div class="ibox float-e-margins i-box-mimi">
	            <div class="ibox-title">
	                <div class="row">
	            		<div class="col-sm-8">
	                		<h4 class="input-font-mimi-big">Search By Code</h4>
						</div>
						<div class="col-sm-4">
							<div class="sk-spinner sk-spinner-chasing-dots pull-right" v-if="loadingCodes">
                                <div class="sk-dot1"></div>
                                <div class="sk-dot2"></div>
                            </div>
						</div>
	                </div>
	            </div>
	            <div class="ibox-content">
	                <form method="GET" action="/api/species/" v-ajax>
		            {!! csrf_field() !!}
		            <div class="row">
						<div class="col-sm-8 has-success">
							<input type="text"
							class="form-control input-lg input-font-mimi-normal"
			                v-model="queryCode"
			                v-on:keyup="searchCodes"
			                v-on:click="resetQueries"
			            	>
		            	</div>
		            	<div class="col-sm-4">
		            		<button type="submit" class="btn btn-primary btn-lg pull-right" v-show="searchingCodes"><strong>Search</strong></button>
		            	</div>
					</div>	
					</form>
					<div class="row" v-if="!isSearching">
						<div class="col-sm-8">
			 				<species-codes :list="searchedCodes"></species-codes>
			 			</div>
			 		</div>
	            </div>
	        </div>
	        @if ($species)
            	<input type="hidden" v-model="outCode = '{!! $species->species_code !!}'">
            	<input type="hidden" v-model="outSpeciesName = '{!! $species->species_name !!}'">
            @endif
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
		<div class="ibox float-e-margins">
			 <div class="ibox-title">
            	<div class="row">
            		<div class="col-sm-12">
                		<h4 class="input-font-mimi-big">Species Information</h4>
					</div>
                </div>
            </div>
            <div class="ibox-content">
            	<div class="row">
            		<div class="col-lg-4">
						<div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
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
					<div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
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
		           <div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
						<div class="p-m">
							<h2>Biogeographic Regions</h2>
						</div>
						<div class="p-m">
							<h4>@{{ speciesDetails.bioregions }}</h4>
						</div>
					</div>							
				</div>
				
				<div class="col-lg-4">
					<div class="widget lazur-bg no-padding animated bounceInUp" v-if="dataAvailable">
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
					<div class="widget lazur-bg no-padding animated bounceInUp" v-if="dataAvailable">
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
			
		</div>
	</div>

	<template id="species-names-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="spec in list" v-on:click="notify(spec, 'names')" style="cursor: default;">
                @{{ spec.species_name }} 
            </li>
        </ul>
    </template>

    <template id="species-codes-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="spec in list" v-on:click="notify(spec, 'codes')" style="cursor: default;">
                @{{ spec.species_code }} 
            </li>
        </ul>
    </template>

@endsection

@section('added-scripts')
	 <script src="{!! asset('js/speciesToCellMapping.js') !!}"></script>
     <script src="{!! asset('js/main.js') !!}"></script>
@endsection