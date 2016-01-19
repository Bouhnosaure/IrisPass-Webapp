var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    "assets": "./resources/assets/",
    "jquery": "./vendor/bower_components/jquery/",
    "jqueryui": "./vendor/bower_components/jquery-ui/",
    "bootstrap": "./vendor/bower_components/bootstrap/",
    "fontawesome": "./vendor/bower_components/font-awesome/",
    "jquerycookie": "./vendor/bower_components/jquery.cookie/",
    "nanoscroller": "./vendor/bower_components/nanoscroller/",
    "jquerygritter": "./vendor/bower_components/jquery.gritter/"
};


elixir(function (mix) {

    mix.copy(paths.bootstrap + 'fonts/', 'public/build/fonts');
    mix.copy(paths.fontawesome + 'fonts/', 'public/build/fonts');

    mix.less("app.less", "public/css/", {
        paths: [
            paths.bootstrap + 'less/',
            paths.fontawesome + 'less/'
        ]
    });

    mix.scripts([
        paths.jquery + "dist/jquery.js",
        paths.jqueryui + "jquery-ui.js",
        paths.jquerycookie + "jquery.cookie.js",
        paths.nanoscroller + "bin/javascripts/jquery.nanoscroller.js",
        paths.jquerygritter + "js/jquery.gritter.js",
        paths.bootstrap + "dist/js/bootstrap.js",
        paths.assets + "js/core.js",
        paths.assets + "js/app.js"
    ], "public/js/app.js", "./");

    mix.scripts([
        paths.jquery + "dist/jquery.js",
        paths.bootstrap + "dist/js/bootstrap.js"
    ], "public/js/light.js", "./");

    mix.version(["public/css/app.css", "public/js/app.js", "public/js/light.js"]);

});