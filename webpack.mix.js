let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/js/main.js', 'public/js')
    .js('resources/js/lazyload.js', 'public/js')
    .js('resources/js/owl.carousel.custom.js', 'public/js')
    .sass('resources/sass/style.scss', 'public/css')
    .sass('resources/sass/responsive.scss', 'public/css');

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/style.scss', 'public/css')
//     .sass('resources/sass/app.scss', 'public/css');