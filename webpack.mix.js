const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 //        'public/assets/js/google-map.js',
 */

mix.js('resources/js/app.js', 'public/js')
    .scripts([
        'public/assets/js/jquery.min.js',
        'public/assets/js/jquery-migrate-3.0.1.min.js',
        'public/assets/js/popper.min.js',
        'public/assets/js/bootstrap.min.js',
        'public/assets/js/jquery.easing.1.3.js',
        'public/assets/js/jquery.waypoints.min.js',
        'public/assets/js/jquery.stellar.min.js',
        'public/assets/js/owl.carousel.min.js',
        'public/assets/js/jquery.magnific-popup.min.js',
        'public/assets/js/aos.js',
        'public/assets/js/jquery.animateNumber.min.js',
        'public/assets/js/bootstrap-datepicker.js',
        'public/assets/js/scrollax.min.js',
        'public/assets/js/main.js'
    ], 'public/js/all.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
