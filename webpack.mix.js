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

mix.js('resources/js/app.js', 'public/js').version()
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.styles(['public/css/all.css', ], 'public/css/main.css');
mix.styles(['public/css/font.css', ], 'public/css/fontawesome.css');
mix.styles(['public/css/scroll.css', ], 'public/css/scroll.css');
mix.styles([
    'public/assets/css/bootstrap.min.css',
    'public/assets/css/carousel.css',
    'public/assets/css/common.css',
    'public/assets/css/main.css',
    'public/assets/css/responsive.css',
    'public/assets/css/scroll.css', ], 'public/assets/css/all.css').version();


mix.js([

    'public/js/dash.js',
    'public/js/app1.js',


], 'public/js/main.js');
