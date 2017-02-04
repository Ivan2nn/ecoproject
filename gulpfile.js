var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');

    mix.styles([

		'vendor/bootstrap.min.css',
        'vendor/font-awesome-4.6.3/css/font-awesome.css',
        'vendor/vakate-jstree/default/style.min.css',
        'vendor/switchery.css',
        'vendor/style.css',
        'app.css'

    ], 'public/output/final.css', 'public/css');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/icon-fonts/styles.css',
        'vendor/jquery.vegas.min.css',
        'vendor/pixeden-icons.css',
        'vendor/owl.theme.css',
        'vendor/owl.carousel.css',
        'vendor/animate.min.css',
        'vendor/responsive.css',
        'vendor/zerif/styles.css',
        'app.css'

    ], 'public/output/main.css', 'public/css');

    mix.scripts([
    	'vendor/jquery-2.1.1.js',
    	'vendor/bootstrap.min.js',
    	'vendor/vue.min.js',
    	'vendor/vue-resource.min.js',
    	'vendor/plugins/metisMenu/jquery.metisMenu.js',
    	'vendor/plugins/slimscroll/jquery.slimscroll.min.js',
        'vendor/jstree.min.js',
        
    	'vendor/inspinia.js',

    	'vendor/plugins/pace/pace.min.js'
    ], 'public/output/final.js', 'public/js');

    mix.scripts([
        'vendor/wow.min.js',
        'vendor/jquery.nav.js',
        'vendor/jquery.knob.js',
        'vendor/owl.carousel.min.js',
        'vendor/smoothscroll.js',
        'vendor/jquery.vegas.min.js',
        'vendor/zerif.js'
    ], 'public/output/main.js', 'public/js');

    mix.copy('public/css/vendor/font-awesome-4.6.3/fonts', 'public/fonts');
    mix.copy('public/css/vendor/vakate-jstree/default', 'public/output');

});
