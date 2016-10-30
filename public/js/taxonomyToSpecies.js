Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('input[name="_token"]').value;

Vue.directive('ajax', {
	
	bind: function() {
		this.el.addEventListener('submit', this.onSubmit.bind(this));
	},

	update: function() {

	},

	onSubmit: function(e) {
		e.preventDefault();
		this.vm.loading = true;
		// For the moment we use a string
		//var kingdomQuery = vm.selectedKingdom ? "k" + vm.selectedKingdom : "k" + '0';
		//var phylumQuery = vm.selectedPhylum ? 'p' + vm.selectedPhylum : 'p' +  '0' ;
		//var classQuery = vm.selectedClassis ? 'c' + vm.selectedClassis : 'c' + '0' ;
		//var orderQuery = vm.selectedOrder ? 'o' + vm.selectedOrder : 'o' + '0' ;
		//var familyQuery = vm.selectedFamily ? 'f' + vm.selectedFamily : 'f' + '0' ;
		//var genusQuery = vm.selectedGenus ? 'g' + vm.selectedGenus : 'g' + '0' ;
		var checked_ids = []; 

		console.log($("#Animalia_jstree").jstree("get_selected",true));
           console.log(checked_ids); 
		//var taxonomyQuery = kingdomQuery + ':' + phylumQuery + ':' + classQuery + ':' + orderQuery + ':' + familyQuery + ':' + 'g103';

		//this.vm.$http.get(this.el.action + taxonomyQuery).then((response) => {
			// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
		//	this.vm.speciesDetails = JSON.parse(response.data);
		//this.vm.loading = false;
		//}, (response) => {

		//});
	}
});

Vue.component('species', {
	template: '#species-template',

	props: ['list'],

	data: function() {
		return {
			list: []
		};
	},

	methods: {
		notify: function (spec) {
			this.$dispatch('child-obj', spec);
      	}
	}
});

Vue.component('multi-species-info-cell', {
	template: '#multi-species-info-cell-template',

	props: ['list'],

	data: function() {
		return {
			list: []
		};
	},

	methods: {
		notify: function (spec) {
			this.$dispatch('child-obj', spec);
      	}
	}
});

new Vue({
	el: 'body',

	data: {
		// Taxonomy packet
		taxonomies: [],
		kingdoms: [],
		phyla: [],
		classes: [],
		orders: [],
		families: [],
		genera: [],

		selectedKingdom: '',
		selectedPhylum: '',
		selectedClassis: '',
		selectedOrder: '',
		selectedFamily: '',
		selectedGenus: '',
		loading: false,

		///////////////////////////////////////////

		speciesDetails: [],
		selectedOne: '',

		columns: [
			{
				name: 'species_code',
				title: 'Species Code'
			},
			{
				name: 'species_name',
				title: 'Species Name'
			},
			{
				name: 'kingdom_name',
				title: 'Kingdom'
			},
			{
				name: 'phylum_name',
				title: 'Phylum'
			},
			{
				name: 'classis_name',
				title: 'Class'
			},
			{
				name: 'order_name',
				title: 'Order'
			},
			{
				name: 'family_name',
				title: 'Family'
			},
			{
				name: 'genus_name',
				title: 'Genus'
			},          
        ]
	},

	ready: function() {
		vm = this;
		this.$http.get('/api/taxonomy').then((response) => {
			vm.kingdoms = response.data['kingdoms'];
			vm.phyla = response.data['phyla'];
			vm.classes = response.data['classes'];
			vm.orders = response.data['orders'];
			vm.families = response.data['families'];
			vm.genera = response.data['genera'];

		}, (response) => {
			alert('No data avilable');
		});
	},

	computed: {
		searched: function() {
			vm = this;
			searchedValues = [];
			if (this.query) {
				searchedValues = this.species.filter(this.filterQuery(this.query));
			}

			return searchedValues;
		},

		// We create a computed property to check if at least one of the multiple options has been chosen (otherwise they just could see all the species)
		searchActivated: function() {
			vm = this;
			return (vm.selectedKingdom != '' || vm.selectedPhylum != '' 
				|| vm.selectedClassis != '' || vm.selectedOrder != '' || vm.selectedFamily != '' 
				|| vm.selectedGenus != '');
		},

		// We will use a computed property where we will keep all the specific parameters that we have to use for the research of the species
		// It will be an array consumed by the api/taxonomy
		/*taxonomyParameters: function() {
			vm = this;
			taxParameters = [];
			if (vm.searchActivated) {
				taxParameters['selectedKingdom'] = vm.selectedKingdom; 
				taxParameters['selectedPhylum'] = vm.selectedPhylum;
				taxParameters['selectedClassis'] = vm.selectedClassis;
				taxParameters['selectedOrder'] = vm.selectedOrder;
				taxParameters['selectedFamily'] = vm.selectedFamily;
				taxParameters['selectedGenus'] = vm.selectedGenus;
			}	
			return taxParameters;
		}*/
	},

	methods: {

		filterQuery: function(queryString) {
			return function(element) {
				return element.species_name.toLowerCase().startsWith(queryString.toLowerCase());
			}
		},

		search: function() {
			vm = this;
			if (this.query) {
				this.searched = this.species.filter(this.filterQuery(this.query));
			} else {
				this.searched = [];
			}
		},

		getSpeciesGeographicPositions: function() {
			vm = this;
			this.$http.get('/api/species/').then((response) => {
				vm.species = response.data;
			}, (response) => {
				alert('No data available');
			});
		}
	},

	events: {
    	'child-obj': function (childObj) {
	      	// `this` in event callbacks are automatically bound
	      	// to the instance that registered it
	      	this.selectedOne = childObj;
	      	this.query = childObj.species_name;
    	},

    	'final-map-data': function(finalMapData) {
    		window.setMappingData(finalMapData);
    	}
  	}
});