Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('input[name="_token"]').value;

Vue.directive('ajax', {
	
	bind: function() {
		this.el.addEventListener('submit', this.onSubmit.bind(this));
	},

	update: function() {

	},

	// Remeber that we have to put a regex forcing the cellcode to start with 10 to block attacks
	// (in the routes?)...at the moments selectedOne is a string
	onSubmit: function(e) {
		e.preventDefault();
		this.vm.loading = true;
		//console.log(this.el.action + this.vm.selectedCell);
		console.log('test');
		this.vm.$http.get(this.el.action + this.vm.selectedCell).then((response) => {
			//this.vm.$dispatch('final-cell-data', response.data);
		this.vm.species = response.data.species;
		this.vm.loading = false;
		}, (response) => {

		});
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

this.myVue = new Vue({
	el: 'body',

	data: {
		species: [],
		selectedCell: '',
		loading: false
	},

	methods: {

		getSpeciesFromCellCode: function() {
			vm = this;
			this.$http.get('/api/cell/').then((response) => {
				vm.species = response.data;
			}, (response) => {
				alert('No data avilable');
			});
		}
	},

	events: {
    	'child-obj': function (childObj) {
	      	// `this` in event callbacks are automatically bound
	      	// to the instance that registered it
	      	this.selectedOne = childObj;
	      	this.query = childObj.name;
    	},

    	'final-map-data': function(finalMapData) {
    		window.setMappingData(finalMapData);
    	}
  	}
});