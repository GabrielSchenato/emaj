const mix = require('laravel-mix');

const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')
module.exports = {
    plugins: [
        new VuetifyLoaderPlugin()
    ]
};

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources/js'
        }
    },
    plugins: [
        new VuetifyLoaderPlugin(),
    ]
});

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
    .sass('resources/sass/app.scss', 'public/css')
    .version();

mix.styles([
    'resources/institucional/css/open-iconic-bootstrap.min.css',
    'resources/institucional/css/animate.css',
    'resources/institucional/css/owl.carousel.min.css',
    'resources/institucional/css/owl.theme.default.min.css',
    'resources/institucional/css/magnific-popup.css',
    'resources/institucional/css/aos.css',
    'resources/institucional/css/ionicons.min.css',
    'resources/institucional/css/bootstrap-datepicker.css',
    'resources/institucional/css/jquery.timepicker.css',
    'resources/institucional/css/flaticon.css',
    'resources/institucional/css/font-awesome.css',
    'resources/institucional/css/icomoon.css',
    'resources/institucional/css/style.css'
], 'public/css/institucional.css');


mix.scripts([
    'resources/institucional/js/jquery.min.js',
    'resources/institucional/js/jquery-migrate-3.0.1.min.js',
    'resources/institucional/js/popper.min.js',
    'resources/institucional/js/bootstrap.min.js',
    'resources/institucional/js/jquery.easing.1.3.js',
    'resources/institucional/js/jquery.waypoints.min.js',
    'resources/institucional/js/jquery.stellar.min.js',
    'resources/institucional/js/owl.carousel.min.js',
    'resources/institucional/js/jquery.magnific-popup.min.js',
    'resources/institucional/js/aos.js',
    'resources/institucional/js/jquery.animateNumber.min.js',
    'resources/institucional/js/bootstrap-datepicker.js',
    'resources/institucional/js/scrollax.min.js',
    'resources/institucional/js/main.js'
], 'public/js/institucional.js');