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
	                <form method="GET" action="/api/habitat/" v-ajax>
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
				 			<habitat-names :list="searchedNames"></habitat-names>
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
	                <form method="GET" action="/api/habitat/" v-ajax>
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
			 				<habitat-codes :list="searchedCodes"></habitat-codes>
			 			</div>
			 		</div>
	            </div>
	        </div>
	        @if ($habitat)
            	<input type="hidden" v-model="outCode = '{!! $habitat->habitat_code !!}'">
            	<input type="hidden" v-model="outHabitatName = '{!! $habitat->habitat_name !!}'">
            @endif
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
            		<div id="habitat-map" style="width: 620px; height: 650px;"></div>
            	</div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="ibox float-e-margins">
			 <div class="ibox-title">
            	<div class="row">
            		<div class="col-sm-12">
                		<h4 class="input-font-mimi-big">Habitat Information</h4>
					</div>
                </div>
            </div>
            <div class="ibox-content">
            	<div class="row">
            		<div class="col-lg-4">
						<div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
							<div class="p-m">
								<h2 class="font-bold">
					                @{{ habitatDetails.habitat_name }}
					            </h2>
					             
							</div>
						</div>
					</div>
            	</div>
            	<div class="row">
				<div class="col-lg-4">
		           <div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
						<div class="p-m">
							<h2>Biogeographic Regions</h2>
						</div>
						<div class="p-m">
							<div class="row">
								<div v-for="bioreg in habitatDetails.bioregions" class="col-md-4">
									<h4>@{{ bioreg }}</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
						<div class="p-m">
							<h2>Macrocategory</h2>
						</div>
						<div class="p-m">
							<h3 class="font-bold">
								@{{ habitatDetails.macrocategory }}
							</h3>
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
										<td><div :class="itemStatusStyle(habitatDetails, 'alp')"></div></td>
										<td><div :class="itemStatusStyle(habitatDetails, 'con')"></div></td>
										<td><div :class="itemStatusStyle(habitatDetails, 'med')"></div></td>
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
										<td><div><span><img v-bind:src="itemTrendStyle(habitatDetails, 'alp')" class="trend-image" /></span></div></td>
										<td><div><span><img v-bind:src="itemTrendStyle(habitatDetails, 'con')" class="trend-image" /></span></div></td>
										<td><div><span><img v-bind:src="itemTrendStyle(habitatDetails, 'med')" class="trend-image" /></span></div></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="widget lazur-bg no-padding animated bounceInUp" v-if="dataAvailable">
						<div class="p-m">
							<h2>Link Scheda</h2>
						</div>
						<div class="p-m">
							<a v-bind:href="document_url" target="_blank"><button class="btn-lg btn-default">Visualizza</button></a>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>

	<template id="habitat-names-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="habitat in list" v-on:click="notify(habitat, 'names')" style="cursor: default;">
                @{{ habitat.habitat_name }} 
            </li>
        </ul>
    </template>

    <template id="habitat-codes-template">
        <ul class="list-group">      
            <li class="list-group-item" v-for="habitat in list" v-on:click="notify(habitat, 'codes')" style="cursor: default;">
                @{{ habitat.habitat_code }} 
            </li>
        </ul>
    </template>

@endsection

@section('added-scripts')
	 <script src="{!! asset('js/habitatToCellMapping.js') !!}"></script>
     <script src="{!! asset('js/main_habitat.js') !!}"></script>
@endsection