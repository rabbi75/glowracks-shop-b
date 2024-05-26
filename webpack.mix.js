const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'public/frontEnd/css/bootstrap.min.css',
    'public/frontEnd/css/animate.css',
    'public/frontEnd/css/font-awesome.min.css',
    'public/frontEnd/css/owl.carousel.min.css',
    'public/frontEnd/css/owl.theme.default.min.css',
    'public/frontEnd/css/swiper.min.css',
    'public/frontEnd/css/mobile-menu.css',
    'public/frontEnd/css/jquery.mtree.css',
    'public/frontEnd/css/nice-select.css',
    'public/frontEnd/css/mtree.css',
    'public/frontEnd/css/zoom.css',
    'public/frontEnd/css/style.css',
    'public/frontEnd/css/responsive.css',
],  'public/frontEnd/css/all.css');

mix.scripts([
    'public/frontEnd/js/jquery-3.3.1.min.js',
    'public/frontEnd/js/popper.min.js',
    'public/frontEnd/js/bootstrap.min.js',
    'public/frontEnd/js/owl.carousel.min.js',
    'public/frontEnd/js/swiper.min.js',
    'public/frontEnd/js/jquery.sticky.js',
    'public/frontEnd/js/jquery.nice-select.js',
    'public/frontEnd/js/jquery.scrollUp.js',
    'public/frontEnd/js/mobile-menu.js',
    'public/frontEnd/js/mtree.js',
    'public/frontEnd/js/script.js',
],  'public/frontEnd/js/all.js');
