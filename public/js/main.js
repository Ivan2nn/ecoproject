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
		this.vm.$http.get(this.el.action + this.vm.selectedOne.species_code).then((response) => {
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

new Vue({
	el: 'body',

	data: {
		query: '',
		species: [],
		speciesDetails: [],
		selectedOne: '',
		loading: false
	},

	ready: function() {
		vm = this;
		this.$http.get('/api/species').then((response) => {
			vm.species = response.data;
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
		}
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