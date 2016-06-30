module.exports = function(grunt) {
    require('time-grunt')(grunt);
    require('load-grunt-tasks')(grunt);

    var configurator = require('./configurator')(grunt, {
        sass: {
            options: {
                style: 'compressed',
            }
        },
        postcss: {
            options: {
                map: false,
                processors: [
                    require('autoprefixer')({browsers: 'last 2 versions'}),
                    require('cssnano')()
                ]
            }
        },
        imagemin: {},
        browserify: {},
        uglify: {},
        watch: {
            options: {
                interrupt: true,
                livereload: true
            },
            twig: {
                files: ['**/*.twig'],
                tasks: []
            }
        }
    });

    configurator.register(function(registerBundle) {
        registerBundle('App')
            // Compile src/AppBundle/Resources/private/scss/app.scss
            .style('app').addWatch((path) => [

                // When src/AppBundle/Resources/private/scss/App/**/* changes
                path('App/**/*'),
            ])
            // Compile src/AppBundle/Resources/private/javascript/App/app.scss
            .script('App/app').addWatch((path) => [
                // When src/AppBundle/Resources/private/javascript/App/**/* changes
                path('App/**/*'),
            ])
            .script('Login/login').addWatch((path) => [
                path('Login/**/*'),
            ]);
    });
    // When changing this configuration, do
    // grunt symfony:assets
    // bin/console assets:install --symlink
    // To sync the new files with symlinks

    grunt.initConfig(configurator.get());
};
