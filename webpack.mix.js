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

/* mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .js('node_modules/popper/dist/popper.js', 'public/js').sourceMaps(); */

mix.styles([
        'resources/vendor/fontawesome/css/all.min.css',
        'resources/vendor/css/adminlte.min.css',
        'resources/vendor/css/verkabill.css',
    ], 'public/css/template.css')
    .js('resources/js/app.js', 'public/js') //JQuery, Bootstrap, VueJS
    .vue()
    .scripts([
        'resources/vendor/js/adminlte.min.js',
        'resources/vendor/js/demo.js',
    ], 'public/js/template.js')
    .copy('resources/vendor/fontawesome/webfonts', 'public/webfonts');
