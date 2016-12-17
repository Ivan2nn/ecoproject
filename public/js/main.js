Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('input[name="_token"]').value;
Vue.config.devtools = true;

Vue.directive('ajax', {
	
	bind: function() {
		this.el.addEventListener('submit', this.onSubmit.bind(this));
	},

	update: function() {

	},

	onSubmit: function(e) {
		e.preventDefault();
		this.vm.loading = true;
		console.log(this.el.action);
		this.vm.$http.get(this.el.action + this.vm.code).then((response) => {
			// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
			this.vm.$dispatch('final-map-data', response.data);
			this.vm.speciesDetails = JSON.parse(response.data)['species'];
		this.vm.loading = false;
		}, (response) => {

		});
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

Vue.component('info-cell', {
	template: '#info-cell-template',

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

/*Vue.component('species-info', {
	template: '#species-info-template',

	props: ['species-details'],
});*/

new Vue({
	el: 'body',

	data: {
		query: '',
		code: '',
		outCode: '',
		outSpeciesName: '',
		species: [],
		speciesDetails: [],
		selectedOne: '',
		dataAvailable: false,
		filterSpecies: true,
		loading: false
	},

	ready: function() {
		vm = this;
		this.$http.get('/species').then((response) => {
			vm.species = response.data;
		}, (response) => {
			alert('No data avilable');
		});

		// We keep the filterSpecies boolean true if we land on the page without any data requested from other pages
		// If we land on the page with a specific species requested from other pages we will not activate the filter on the species
		// If someone clicks inside the input box we can reactivate the filter cause it means that he wants to make a new search
		if (vm.outSpeciesName != '') {
			vm.query = vm.outSpeciesName;
			vm.code = vm.outCode;
			vm.filterSpecies = false;
			vm.loading = true;
			vm.$http.get('/api/species/' + vm.code).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				this.$dispatch('final-map-data', response.data);
				this.speciesDetails = JSON.parse(response.data)['species'];
				this.dataAvailable = true;
				this.loading = false;
			}, (response) => {

			});
		}
	},

	computed: {
		searched: function() {
			if (this.filterSpecies == true) {
				vm = this;
				searchedValues = [];
				if (this.query) {
					searchedValues = this.species.filter(this.filterQuery(this.query));
				}
				return searchedValues;
			}
		}
	},

	methods: {

		resetQuery: function() {
			this.query = '';
			this.code = '';
			this.filterSpecies = true;
			this.outSpeciesName = '';
			this.outCode = '';
		},

		filterQuery: function(queryString) {
			return function(element) {
				return element.species_name.toLowerCase().startsWith(queryString.toLowerCase());
			}
		},

		search: function() {	
			vm = this;
			if (this.query) {
				console.log(this.query);
				this.searched = this.species.filter(this.filterQuery(this.query));
			} else {
				this.searched = [];
			}	
		},

		getSpeciesGeographicPositions: function() {
			vm = this;
			this.$http.get('/species').then((response) => {
				vm.species = response.data;
			}, (response) => {
				alert('No data available');
			});
		},

		itemStatusStyle: function(item, bioreg) {
      		
      		temp = 'item.species_conservation_' + bioreg;
      		
      		if (eval(temp) == 'U2') {
      			return 'red-rectangle';
      		};

      		if (eval(temp) == 'U1') {
      			return 'yellow-rectangle';
      		};

      		if (eval(temp) == 'FV') {
      			return 'green-rectangle';
      		};

      		if (eval(temp) == 'XX') {
      			return 'grey-rectangle';
      		};

      		if (eval(temp) == '') {
      			return 'fa arrow-big fa-minus';
      		};

      	},

      	itemTrendStyle: function(item, bioreg) {
      		
      		var temp = 'item.species_trend_' + bioreg;

      		console.log(eval(temp));
      		
      		if (eval(temp) == '-') {
      			return 'fa fa-level-down arrow-big color-red';
      		};

      		if (eval(temp) == '=') {
      			return 'fa fa-arrows-h arrow-big color-yellow';
      		};

      		if (eval(temp) == '+') {
      			return 'fa fa-level-up arrow-big color-green';
      		};

      		if (eval(temp) == 'x') {
      			return 'fa fa-question arrow-big color-grey';
      		};

      		if (eval(temp) == '') {
      			return 'fa arrow-big fa-minus';
      		};

      	},
	},

	events: {
    	'child-obj': function (childObj) {
	      	// `this` in event callbacks are automatically bound
	      	// to the instance that registered it
	      	this.selectedOne = childObj;
	      	this.query = childObj.species_name;
	      	this.code = childObj.species_code;
    	},

    	'final-map-data': function(finalMapData) {
    		window.setMappingData(finalMapData);
    	}
  	}
});