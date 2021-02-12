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

// More about Laravel Mix https://laravel.com/docs/7.x/mix
// Customize Own CSS | Javascript Style and Different File CSS | JavaScript
mix.js('resources/js/custom.js', 'public/js')
    .sass('resources/sass/custom.scss', 'public/css');



