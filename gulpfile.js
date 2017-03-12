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

		'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/animate/animate.min.css',
        'vendor/revo-slider/css/settings.css',
        'vendor/revo-slider/css/layers.css',
        'vendor/revo-slider/css/navigation.css',
        'vendor/ilightbox/css/ilightbox.css',
        'vendor/base/plugins.css',
        'vendor/base/components.css',
        'vendor/base/themes/default.css',
        'vendor/base/custom.css',
        'vendor/vakate-jstree/default/style.min.css',
        'vendor/switchery.css',
        'app.css'

    ], 'public/output/final.css', 'public/css');


    mix.scripts([
    	'vendor/jquery.min.js',
        'vendor/jquery-migrate.min.js',
        'vendor/bootstrap.min.js',
        'vendor/jquery.easing.min.js',
    	'vendor/vue.min.js',
    	'vendor/vue-resource.min.js',
    	'vendor/plugins/reveal-animate/wow.js',
        'vendor/plugins/revo-slider/js/jquery.themepunch.tools.min.js',
        'vendor/plugins/revo-slider/js/jquery.themepunch.revolution.min.js',
        'vendor/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js',
        'vendor/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js',
        'vendor/plugins/revo-slider/js/extensions/revolution.extension.navigation.min.js',
        'vendor/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js',
        'vendor/plugins/revo-slider/js/extensions/revolution.extension.video.min.js',
        'vendor/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js',
        'vendor/plugins/owl-carousel/owl.carousel.min.js',
        'vendor/plugins/counterup/jquery.waypoints.min.js',
        'vendor/plugins/counterup/jquery.counterup.min.js',
        'vendor/plugins/fancybox/jquery.fancybox.pack.js',
        'vendor/plugins/smooth-scroll/jquery.smooth-scroll.js',
        'vendor/plugins/slider-for-bootstrap/js/bootstrap-slider.js',
        'vendor/jstree.min.js',
        'vendor/components.js',
        'vendor/slider-4.js',
        'vendor/plugins/isotope/isotope.pkgd.min.js',
        'vendor/plugins/isotope/imagesloaded.pkgd.min.js',
        'vendor/plugins/isotope/packery-mode.pkgd.min.js',
        'vendor/plugins/ilightbox/js/jquery.requestAnimationFrame.js',
        'vendor/plugins/ilightbox/js/jquery.mousewheel.js',
        'vendor/plugins/ilightbox/js/ilightbox.packed.js',
        'vendor/isotope-gallery.js',
        'vendor/app.js'
        
    ], 'public/output/final.js', 'public/js');

    mix.copy('public/css/vendor/font-awesome-4.6.3/fonts', 'public/fonts');
    mix.copy('public/css/vendor/vakate-jstree/default', 'public/output');

});
