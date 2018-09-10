let mix = require('laravel-mix');

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

mix.less('resources/assets/less/app.less', 'public/css/app.css')
    .copy('./node_modules/bootstrap/dist/fonts/', 'public/fonts')
    .copy('./node_modules/orchid-icons/dist/fonts/', 'public/fonts')
    .copy('resources/assets/js/worker.js', 'public/js/worker.js')
    .js(['resources/assets/js/app.js'], 'public/js/app.js')
    .version();
