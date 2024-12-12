const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/views.js', 'public/js') // Add this line for dataForms.js
   .postCss('resources/css/app.css', 'public/CSS', [
       //
   ]);
