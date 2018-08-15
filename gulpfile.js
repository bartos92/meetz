let gulp = require('gulp');

gulp.task('default', function() {
    return gulp.src(paths.admin.js)
        .pipe(concat('app.js'))
        .pipe(gulpif(env === 'prod', uglify))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(adminRootPath + 'js/'))
        ;
});

function component(append) { return 'node_modules/' + append; }
function fonts(name) { return _.map(['.eot', '.svg', '.ttf', '.woff', '.woff2'], function (ext) { return component(name + ext); }); }

var assets = {
    js: [
        component('bootstrap/dist/js/bootstrap.js'),
    ],
    minifiedScripts: [
        component('jquery/dist/jquery.min.js'),
        component('lodash/lodash.min.js'),
    ],
    styles: [
        component('bootstrap/dist/css/bootstrap.min.css'),
        component('@fortawesome/fontawesome-pro/css/all.css')
    ],
    fonts: fonts('@fortawesome/fontawesome-pro/webfonts/*').concat(
        fonts('bootstrap/dist/fonts/**/*')
    )
};
