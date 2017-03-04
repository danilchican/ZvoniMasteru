const elixir = require('laravel-elixir');
var gulp = require('gulp');
var uglify = require('gulp-uglify');
var dest = require('gulp-dest');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
        .sass('admin-styles.scss', 'public/css/admin')
       .webpack('app.js')
        .webpack('admin.js', 'public/js/admin/admin.js')
        .webpack('account.js', 'public/js/account.js');
});


gulp.task('minify', function() {
    // Минифицируем и копируем все JavaScript файлы,

    gulp.src(['public/js/account.js'])
        .pipe(uglify())
        .pipe(dest('./public/js/:name.min.js'))
        .pipe(gulp.dest('./public/js'))
});
