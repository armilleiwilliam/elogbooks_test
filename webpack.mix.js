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
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .react();

/*mix.postCss('resources/css/main.css', 'public/css', [
  require('tailwindcss'),
]);*/

mix.copyDirectory('node_modules/tinymce/icons', 'public/js/tinymce/icons');
mix.copyDirectory('node_modules/tinymce/plugins', 'public/js/tinymce/plugins');
mix.copyDirectory('node_modules/tinymce/skins', 'public/js/tinymce/skins');
mix.copyDirectory('node_modules/tinymce/themes', 'public/js/tinymce/themes');
/*mix.copy('node_modules/tinymce/jquery.tinymce.js', 'public/js/tinymce/jquery.tinymce.js');
mix.copy('node_modules/tinymce/jquery.tinymce.min.js', 'public/js/tinymce/jquery.tinymce.min.js');
mix.copy('node_modules/tinymce/tinymce.js', 'public/js/tinymce/tinymce.js');*/
mix.copy('node_modules/tinymce/tinymce.min.js', 'public/js/tinymce/tinymce.min.js');
