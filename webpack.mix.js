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
    .js('resources/js/sheets/create.js', 'public/js/sheets')
    .js('resources/js/sheets/edit.js', 'public/js/sheets')
    .js('resources/js/sheets/login.js', 'public/js/sheets')
    .js('resources/js/sheets/show.js', 'public/js/sheets')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/questioner.scss', 'public/css')
    .sass('resources/sass/responder.scss', 'public/css')
    .sourceMaps();
