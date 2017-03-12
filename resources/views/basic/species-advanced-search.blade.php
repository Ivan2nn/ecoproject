@extends('partials.layout')

@section('content')

<div class="c-content-box c-size-md c-bg-white">
  <div class="container">
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
                <form method="GET" action="taxonomytospecies" @submit.prevent="searchSpeciesFromTaxonomy">
                      {!! csrf_field() !!}
                  <div class="row">
                    @foreach($kingdoms as $kingdom)
                      @if ($kingdom->kingdom_name != 'Bacteria' && $kingdom->kingdom_name != 'Fungi' && $kingdom->kingdom_name != 'Plantae' && $kingdom->kingdom_name != 'Protista')
                        <div class="panel-group" id="accordion">
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
                                  <li data-jstree='{"icon":"../images/phylum_vlittle.png"}' rel="phylum">{{ $phylum->phylum_name }}
                                    <ul>
                                    @foreach($phylum->classes() as $class)
                                      <li data-jstree='{"icon":"../images/class_vlittle.png"}' rel="class">{{ $class->class_name }}
                                        <ul>
                                        @foreach($class->orders() as $order)
                                        <li data-jstree='{"icon":"../images/order_vlittle.png"}' rel="order">{{ $order->order_name }}
                                          <ul>
                                          @foreach($order->families() as $family)
                                          <li data-jstree='{"icon":"../images/family_vlittle.png"}' rel="family">{{ $family->family_name }}
                                            <ul>
                                            @foreach($family->genera() as $genus)
                                              <li data-jstree='{"icon":"../images/genus_vlittle.png"}' rel="genus" code='{{ $genus->genus_code }}'>{{ $genus->genus_name }}</li>
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
                                  </li>
                                @endforeach
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                    @endforeach

                    
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="input-group">
                        
                        <button type="submit" id="taxonomy_submit" class="btn btn-primary" v-show="true"><strong>Search</strong></button>         
                      </div>  
                    </div>
                  </div>
                </form>
              </div>

              <div class="col-sm-12 col-md-4">

                <form method="GET" action="biogeographicregtospecies" @submit.prevent="searchSpeciesFromBioreg">
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
                <form method="GET" action="conservationstatetospecies" @submit.prevent="searchSpeciesFromConservationStatus">
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
      <multi-species-info-cell :list="speciesDetails"></multi-species-info-cell>
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
   <script src="{!! asset('js/vendor/switchery.js') !!}"></script>
	 <script src="{!! asset('js/taxonomy_regbio_status_to_species.js') !!}"></script>
   <script src="{!! asset('js/taxonomy_main.js') !!}"></script>
   
@endsection