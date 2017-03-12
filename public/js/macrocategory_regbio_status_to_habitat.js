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

		if (e.explicitOriginalTarget.id == 'macrocategory_submit')
		{
			var allMacrocatSelectors = document.querySelectorAll('[class^="js-switch-mac"]');
			var macrocat_checks = {};

			allMacrocatSelectors.forEach(function(elm) {
				macrocat_checks["MAC" + elm.className.slice(-1)] = elm.checked;
			});
			
			this.vm.$http.get(this.el.action, {params: { macrocat_checks: macrocat_checks } }).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				//console.log(JSON.parse(response.data));
				this.vm.habitatDetails = JSON.parse(response.data);
				this.vm.loading = false;
			}, (response) => {

			});
		}

		if (e.explicitOriginalTarget.id == 'regbio_submit')
		{
			var switchery_alp = document.querySelector('.js-switch-alp');
			var switchery_con = document.querySelector('.js-switch-con');
			var switchery_med = document.querySelector('.js-switch-med');

			var regbio_checks = {"ALP" : switchery_alp.checked, "CON" : switchery_con.checked, "MED" : switchery_med.checked};
			
			console.log(this.el.action);
			this.vm.$http.get(this.el.action, {params: { regbio_checks: regbio_checks } }).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				//	console.log(JSON.parse(response.data));
				this.vm.habitatDetails = JSON.parse(response.data);
				this.vm.loading = false;
			}, (response) => {

			});
		}

		if (e.explicitOriginalTarget.id == 'status_conserve_submit')
		{
			var switchery_status_fv = document.querySelector('.js-switch-status-fv');
			var switchery_status_u1 = document.querySelector('.js-switch-status-u1');
			var switchery_status_u2 = document.querySelector('.js-switch-status-u2');
			var switchery_status_xx = document.querySelector('.js-switch-status-xx');

			var status_checks = {"FV" : switchery_status_fv.checked, "U1" : switchery_status_u1.checked, "U2" : switchery_status_u2.checked, "XX" : switchery_status_xx.checked};
			
			this.vm.$http.get(this.el.action, {params: { status_checks: status_checks } }).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				//console.log(JSON.parse(response.data));
				this.vm.habitatDetails = JSON.parse(response.data);
				this.vm.loading = false;
			}, (response) => {

			});
		}
	}
});

Vue.component('habitat', {
	template: '#habitat-template',

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

Vue.component('multi-habitat-info-cell', {
	template: '#multi-habitat-info-cell-template',

	props: ['list'],

	data: function() {
		return {
			list: []
		};
	},

	methods: {
		notify: function (hab) {
			this.$dispatch('child-obj', hab);
      	},

      	itemStatusStyle: function(item, bioreg) {
      		
      		temp = 'item.habitat_conservation_' + bioreg;
      		
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
      		
      		var temp = 'item.habitat_trend_' + bioreg;
      		
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
	}
});

new Vue({
	el: 'body',

	data: {
		// Taxonomy packet
		macrocategories: [],
		habitats: [],
		loading: false,

		///////////////////////////////////////////

		habitatDetails: [],
		selectedOne: '',
	
	},

	methods: {
		searchHabitatsFromMacrocategory: function() {
			var allMacrocatSelectors = document.querySelectorAll('[class^="js-switch-mac"]');
			var macrocat_checks = {};

			allMacrocatSelectors.forEach(function(elm) {
				macrocat_checks["MAC" + elm.className.slice(-1)] = elm.checked;
			});
			
			this.$http.get('/macrocategoriestohabitat', {params: { macrocat_checks: macrocat_checks } }).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				//console.log(JSON.parse(response.data));
				this.habitatDetails = JSON.parse(response.data);
				this.loading = false;
			}, (response) => {

			});
		},

		searchHabitatsFromBioreg: function() {
			var switchery_alp = document.querySelector('.js-switch-alp');
			var switchery_con = document.querySelector('.js-switch-con');
			var switchery_med = document.querySelector('.js-switch-med');

			var regbio_checks = {"ALP" : switchery_alp.checked, "CON" : switchery_con.checked, "MED" : switchery_med.checked};
			
			this.$http.get('/biogeographicregtohabitat', {params: { regbio_checks: regbio_checks } }).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				//	console.log(JSON.parse(response.data));
				this.habitatDetails = JSON.parse(response.data);
				this.loading = false;
			}, (response) => {

			});
		},

		searchHabitatsFromConservationStatus: function() {
			var switchery_status_fv = document.querySelector('.js-switch-status-fv');
			var switchery_status_u1 = document.querySelector('.js-switch-status-u1');
			var switchery_status_u2 = document.querySelector('.js-switch-status-u2');
			var switchery_status_xx = document.querySelector('.js-switch-status-xx');

			var status_checks = {"FV" : switchery_status_fv.checked, "U1" : switchery_status_u1.checked, "U2" : switchery_status_u2.checked, "XX" : switchery_status_xx.checked};
			
			this.$http.get('/conservationstatetohabitat', {params: { status_checks: status_checks } }).then((response) => {
				// Inside the response data there are also the taxonomy data, but the google map API cna distinguish by itself
				//console.log(JSON.parse(response.data));
				this.habitatDetails = JSON.parse(response.data);
				this.loading = false;
			}, (response) => {

			});
		}


	},

	ready: function() {
		vm = this;
		
	},
});