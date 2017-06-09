var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */



elixir(function(mix) {
        mix.scripts([
        'jquery-latest.js',
        'bootstrap.min.js',
        'jquery.datetimepicker.js',
        'jquery-ui.js'
    ], 'public/js/top.js');

                mix.scripts([
        'timer.js',
        'jquery.colorbox.js',
        'common.js',
        'eventdetail.js',
        // 'ckeditor/ckeditor.js',
        'jqueryform.js',
        // 'jquery.validate.min.js',
        // 'locationpicker.jquery.js',
        'sweetalert2.min.js',
        'defaultlayout.js'
    ], 'public/js/bot.js');

           mix.styles([
        
        'colorbox.css',
        'orgdashboard.css',
        'paper-bootstrap.css',
        'jquery.datetimepicker.css',
        'roboto.min.css',
        'sweetalert2.css',
        'roboto4579.css'
    ], 'public/css/all.css');

           mix.styles([
        
        'style.css',
    ], 'public/css/onlystyle.css');
            mix.styles([
        
        'new2.css'
    ], 'public/css/onlynew2.css');

      mix.styles([
        
        'new2.css',
    ], 'public/css/onlynew2.css');

      mix.scripts([
        
        'onsiteplugin_goeventz.js',
    ], 'public/js/onsite_ebot.js');

      mix.scripts([
        
        'onsitetickets.js',
    ], 'public/js/onsite_tbot.js');

           mix.copy('../web/fonts', 'public/build/fonts');
           mix.copy('../web/images', 'public/build/images');
           mix.copy('../web/css', 'public/build/css');


    mix.version(["public/js/top.js","public/js/bot.js","public/css/all.css","public/js/onsite_tbot.js","public/css/onlystyle.css","public/css/onlynew2.css","public/js/onsite_ebot.js"])

});

elixir(function(mix) {
        mix.scripts([
        'autocomplete.js'
    ], 'public/js/autocomplete.min.js');

                mix.scripts([
        'typed.js'
    ], 'public/js/typed.min.js');

                mix.scripts([
        'addtoany.js'
    ], 'public/js/addtoany.min.js');

                mix.scripts([
        'googlemap.js'
    ], 'public/js/googlemap.min.js');

});