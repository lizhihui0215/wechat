var gulp = require('gulp');
var bower = require('gulp-bower');
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



gulp.task('clean',function(){
  return del(['build']);
});

gulp.task('bower', function(){
  return bower();
});

var paths = {
  'bootstrap' : 'vendor/bootstrap/dist',
  'font_awesome' : 'vendor/font-awesome',
  'gritter' : 'vendor/gritter',
  'jquery' : 'vendor/jquery/dist',
  'jquery_ui' : 'vendor/jquery-ui',
  'metisMenu' : 'vendor/metisMenu/dist',
  'PACE' : 'vendor/PACE',
  'peity' : 'vendor/peity',
  'slimScroll' : 'vendor/slimScroll',
  'toastr' : "vendor/toastr",
  'site' : ''
};

// Compile Without Source Maps
elixir.config.sourcemaps = false;

elixir(function(mix) {
  // Run bower install
  mix.task('bower');
  // Copy fonts straight to public
  mix.copy('resources/' + paths.site + '/fonts/**','public/fonts');

  mix.copy('resources/' + paths.font_awesome + '/fonts/**','public/fonts');

  // Copy images straight to public
  mix.copy('resources/' + paths.gritter + '/images/**', 'public/build/images');

  // Merge Site scripts
  mix.scripts([
    '../../' + paths.jquery + '/jquery.js',
    '../../' + paths.bootstrap + '/js/bootstrap.js',
    '../../' + paths.gritter + '/js/jquery.gritter.js',
    '../../' + paths.metisMenu + '/metisMenu.js',
    '../../' + paths.jquery_ui + '/jquery-ui.js',
    '../../' + paths.PACE + '/pace.js',
    '../../' + paths.peity + '/jquery.peity.js',
    '../../' + paths.slimScroll + '/jquery.slimscroll.js',
    '../../' + paths.toastr + '/toastr.js',
    paths.site + '/inspinia.js',
  ], 'public/js/site.js');
  // Merge Site css
  mix.styles([
    '../../' + paths.bootstrap + '/css/bootstrap.css',
    '../../' + paths.gritter + '/css/jquery.gritter.css',
    '../../' + paths.font_awesome + '/css/font-awesome.css',
    '../../' + paths.metisMenu + '/metisMenu.css',
    paths.site + '/style.css',
    paths.site + '/animate.css',
  ], 'public/css/site.css');

  // version
  mix.version(["public/css/site.css","public/js/site.js"]);
});
