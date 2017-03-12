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
		<div class="c-content-box c-size-md c-bg-grey-1">
            <div class="container">
                <div class="row" data-auto-height="true">
                    <div class="col-md-4 c-margin-b-30 wow animate fadeInDown" style="opacity: 1; visibility: visible; animation-name: fadeInDown;">
                        <div class="col-sm-12">
                			<h4 class="input-font-mimi-big">Species Information</h4>
						</div>
					</div>
				</div>
				<div class="row" data-auto-height="true">
                    <div class="col-md-4 c-margin-b-30 wow animate fadeInDown" data-wow-delay="0.2s" style="opacity: 1; visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">
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
                <div class="row" data-auto-height="true">
                    <div class="col-md-4 c-margin-b-30 wow animate fadeInDown" data-wow-delay="0.4s" style="opacity: 1; visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">
                        <div class="widget lazur-bg no-padding animated bounceInLeft" v-if="dataAvailable">
							<div class="p-m">
								<h2>Taxonomy</h2>
							</div>
							<div class="p-m">
								<ul class="list-unstyled m-t-md">
									<li>
					                    <div class="pull-left"><span><img src="{!! asset('images/kingdom_vlittle.png') !!}" /></span><span class="species-information-font">Kingdom:</span></div>
					                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.kingdom }}</h4></div>
					                    <div class="clearfix"></div>   
					                </li>
					                <li>
					                    <div class="pull-left"><span><img src="{!! asset('images/phylum_vlittle.png') !!}" /></span><span class="species-information-font">Phylum:</span></div>
					                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.phylum }}</h4></div>
					                    <div class="clearfix"></div>
					                </li>
					                <li>
					                    <div class="pull-left"><span><img src="{!! asset('images/class_vlittle.png') !!}" /></span><span class="species-information-font">Classis:</span></div> 
					                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.classis }}</h4></div>
					                    <div class="clearfix"></div>
					                </li>
					                <li>
					                    <div class="pull-left"><span><img src="{!! asset('images/order_vlittle.png') !!}" /></span><span class="species-information-font">Order:</span></div>
					                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.order }}</h4></div>
					                    <div class="clearfix"></div>
					                </li>
					                <li>
					                    <div class="pull-left"><span><img src="{!! asset('images/family_vlittle.png') !!}" /></span><span class="species-information-font">Family:</span></div>
					                    <div class="pull-right"><h4 class="text-left">@{{ speciesDetails.family }}</h4></div>
					                    <div class="clearfix"></div>
					                </li>
					                <li>
					                    <div class="pull-left"><span><img src="{!! asset('images/genus_vlittle.png') !!}" /></span><span class="species-information-font">Genus:</span></div>
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
								<div class="row">
									<div v-for="bioreg in speciesDetails.bioregions" class="col-md-4">
										<h4>@{{ bioreg }}</h4>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="col-md-4 c-margin-b-30 wow animate fadeInDown" data-wow-delay="0.4s" style="opacity: 1; visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">
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
											<td><div><span><img v-bind:src="itemTrendStyle(speciesDetails, 'alp')" class="trend-image" /></span></div></td>
											<td><div><span><img v-bind:src="itemTrendStyle(speciesDetails, 'con')" class="trend-image" /></span></div></td>
											<td><div><span><img v-bind:src="itemTrendStyle(speciesDetails, 'med')" class="trend-image" /></span></div></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                    </div>
                    <div class="col-md-4 c-margin-b-30 wow animate fadeInDown" data-wow-delay="0.4s" style="opacity: 1; visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">
                    	<div class="widget lazur-bg no-padding animated bounceInRight" v-if="dataAvailable">
							<div class="p-m">
								<h2>Annex</h2>
							</div>
							<div class="p-m">
								<div class="row">
									<div v-for="annex in speciesDetails.annexes" class="col-md-4">
										<h3>@{{ annex }}</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="widget lazur-bg no-padding animated bounceInRight" v-if="(dataAvailable && speciesDetails.lri_specs)">
							<div class="p-m">
								<h2>Specifiche LRI</h2>
							</div>
							<div class="p-m">
								<div class="row">
									<div class="col-md-12">
										<h3>@{{ speciesDetails.lri_specs }}</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="widget lazur-bg no-padding animated bounceInRight" v-if="(dataAvailable && speciesDetails.iucn_specs">
							<div class="p-m">
								<h2>Specifiche IUCN</h2>
							</div>
							<div class="p-m">
								<div class="row">
									<div class="col-md-12">
										<h3>@{{ speciesDetails.iucn_specs }}</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12 c-margin-b-30 wow animate fadeInDown" data-wow-delay="0.4s" style="opacity: 1; visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;">
                		<div class="widget lazur-bg no-padding animated bounceInRight" v-if="dataAvailable">
							<div class="p-m">
								<h2>Modifica alla specie</h2>
							</div>
							<div class="p-m">
								<div class="row">
									<div class="col-md-6">
										<h3>@{{ speciesDetails.modified.text_of_modification }}</h3>
									</div>
									<div class="col-md-6">
										<h3>Specie Relativa</h3>
										<div v-for="spec in speciesDetails.modified.species">
											<h3>@{{ spec.species_name }} - (@{{ spec.species_code }})</h3>
										</div>
									</div>
								</div>
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
	</div>
</div>

@endsection

@section('added-scripts')
	 <script src="{!! asset('js/speciesToCellMapping.js') !!}"></script>
     <script src="{!! asset('js/main.js') !!}"></script>
@endsection