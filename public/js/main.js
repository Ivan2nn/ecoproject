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
		if (this.vm.searchingNames)
			this.vm.loadingNames = true;
		if (this.vm.searchingCodes)
			this.vm.loadingCodes = true;
		this.vm.isSearching = true;
		this.vm.dataAvailable = false;
		console.log(this.el.action + this.vm.queryCode);
		this.vm.$http.get(this.el.action + this.vm.queryCode).then((response) => {
			// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
			this.vm.$dispatch('final-map-data', response.data);
			this.vm.speciesDetails = JSON.parse(response.data)['species'];
			this.vm.loadingNames = false;
			this.vm.loadingCodes = false;
			this.vm.dataAvailable = true;
		}, (response) => {

		});
	}
});

Vue.component('species-names', {
	template: '#species-names-template',

	props: ['list'],

	data: function() {
		return {
			list: []
		};
	},

	methods: {
		notify: function (spec, searchedField) {
			this.$dispatch('child-obj', spec, searchedField);
      	}
	}
});

Vue.component('species-codes', {
	template: '#species-codes-template',

	props: ['list'],

	data: function() {
		return {
			list: []
		};
	},

	methods: {
		notify: function (spec, searchedField) {
			this.$dispatch('child-obj', spec, searchedField);
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
		notify: function (spec, searchedField) {
			this.$dispatch('child-obj', spec, searchedField);
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
		queryName: '',
		queryCode: '',
		outCode: '',
		outSpeciesName: '',
		species: [],
		speciesDetails: [],
		selectedOne: '',
		dataAvailable: false,
		filterSpecies: true,
		loadingNames: false,
		loadingCodes: false,
		isSearching: false,
		searchingNames: false,
		searchingCodes: false
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
			vm.queryName = vm.outSpeciesName;
			vm.queryCode = vm.outCode;
			vm.filterSpecies = false;
			vm.loadingNames = true;
			vm.$http.get('/api/species/' + vm.queryCode).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				this.$dispatch('final-map-data', response.data);
				this.speciesDetails = JSON.parse(response.data)['species'];
				this.dataAvailable = true;
				this.loadingNames = false;
			}, (response) => {

			});
		}
	},

	computed: {
		searchedNames: function() {
			if (this.filterSpecies == true) {
				vm = this;
				searchedNamesValues = [];
				if (this.queryName) {
					searchedNamesValues = this.species.filter(this.filterQueryNames(this.queryName));
				}
				return searchedNamesValues;
			}
		},

		searchedCodes: function() {
			if (this.filterSpecies == true) {
				vm = this;
				searchedCodesValues = [];
				if (this.queryCode) {
					searchedCodesValues = this.species.filter(this.filterQueryCodes(this.queryCode));
				}
				return searchedCodesValues;
			}
		}
	},

	methods: {

		resetQueries: function() {
			this.queryName = '';
			this.queryCode = '';
			this.filterSpecies = true;
			this.outSpeciesName = '';
			this.outCode = '';
			this.isSearching = false;
			this.loadingNames = false;
			this.searchingNames = false;
			this.searchingCodes = false;
		},

		filterQueryNames: function(queryString) {
			return function(element) {
				return element.species_name.toLowerCase().startsWith(queryString.toLowerCase());
			}
		},

		filterQueryCodes: function(queryString) {
			return function(element) {
				return element.species_code.toString().startsWith(queryString.toLowerCase());
			}
		},

		searchNames: function() {	
			vm = this;
			if (this.queryName) {
				this.searchedNames = this.species.filter(this.filterQueryNames(this.queryName));
			} else {
				this.searchedNames = [];
			}	
		},

		searchCodes: function() {	
			vm = this;
			if (this.queryCode) {
				this.searchedCodes = this.species.filter(this.filterQueryCodes(this.queryCode));
			} else {
				this.searchedCodes = [];
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
      		
      		if (eval(temp) == '-') {
      			return "../images/red_down.png";
      		};

      		if (eval(temp) == '=') {
      			return "../images/yellow_stable.png";
      		};

      		if (eval(temp) == '+') {
      			return "../images/green_up.png";
      		};

      		if (eval(temp) == 'x') {
      			return "../images/red_null.png";
      		};

      		if (eval(temp) == '') {
      			return "../images/grey_null.png";
      		};

      	},
	},

	events: {
    	'child-obj': function (childObj, searchedField) {
	      	// `this` in event callbacks are automatically bound
	      	// to the instance that registered it
	      	// searchedField can be 'names' or 'codes'
	      	this.selectedOne = childObj;
	      	this.queryName = childObj.species_name;
	      	this.queryCode = childObj.species_code;
	      	this.isSearching = true;

	      	if (searchedField == 'names') {
	      		this.searchingNames = true;
	      	}

	      	if (searchedField == 'codes') {
	      		this.searchingCodes = true;
	      	}
    	},

    	'final-map-data': function(finalMapData) {
    		window.setMappingData(finalMapData);
    	}
  	}
});