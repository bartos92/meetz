var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    // the public path you will use in Symfony's asset() function - e.g. asset('build/some_file.js')
    .setManifestKeyPrefix('build/')

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())

    // the following line enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    //.addEntry('js/app', './assets/js/app.js')
    .enableVueLoader()
    .addEntry('js/jquery', './node_modules/jquery/dist/jquery.js')
    .addEntry('js/jsrouting', './public/bundles/fosjsrouting/js/router.js')

    .addEntry('js/base', './assets/app/app.js')

    .addEntry('css/adminLTE', './assets/css/adminlte.css')
    .addEntry('js/adminLTE', './assets//js/adminlte.js')
    // .addEntry('js/assets', './assets//js/npmpackages.js')

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use Sass/SCSS files
    //.enableSassLoader()

    // uncomment for legacy applications that require $/jQuery as a global variable
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
