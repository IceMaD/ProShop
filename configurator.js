module.exports = function(grunt, gruntConfiguration) {
    /**
     * Helper to create an object for grunt configuration
     *
     * @param   {{}|string[]}           configuration
     *
     * @returns {{files: {}|string[]}}
     */
    function files(configuration) {
        return {
            files: configuration
        };
    }

    /**
     * Helper to get an array of grunt tasks
     *
     * @param {string} task     The task name
     * @param {[]}     plugins  All the plugins that should have this task
     *
     * @returns {string[]}
     */
    function tasks(task, plugins) {
        var tasks = [], plugin;

        for (plugin of plugins) {
            tasks.push(plugin + ':' + task)
        }

        return tasks;
    }

    /**
     * Helpers to get symfony paths
     */
    var path = {
        /**
         * @param {string} bundle
         * @param {string} privacy
         *
         * @returns {string}
         */
        root: function(bundle, privacy) {
            return 'src/' + bundle + 'Bundle/Resources/' + privacy + '/';
        },
        /**
         * @param {string} bundle
         * @param {string} privacy
         * @param {string} file
         *
         * @returns {string}
         */
        javascript: function(bundle, privacy, file) {
            return path.root(bundle, privacy) + 'javascript/' + file + '.js';
        },
        /**
         * @param {string} bundle
         * @param {string} privacy
         *
         * @returns {string}
         */
        images: function(bundle, privacy) {
            return path.root(bundle, privacy) + 'images/';
        },
        /**
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {string}
         */
        scss: function(bundle, file) {
            return path.root(bundle, 'private') + 'scss/' + file + '.scss';
        },
        /**
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {string}
         */
        css: function(bundle, file) {
            return path.root(bundle, 'public') + 'css/' + file + '.css';
        }
    };

    /**
     * Helpers to configure tasks
     */
    var configuration = {
        /**
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {{files: ({}}}
         */
        uglify: function(bundle, file) {
            return files({
                [path.javascript(bundle, 'public', file + '.min')]: path.javascript(bundle, 'public', file)
            });
        },
        /**
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {{files: ({}}}
         */
        sass: function(bundle, file) {
            return files({
                [path.css(bundle, file)]: path.scss(bundle, file)
            })
        },
        /**
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {{files: ({}}}
         */
        postcss: function(bundle, file) {
            return files({
                [path.css(bundle, file + '.min')]: path.css(bundle, file)
            })
        },
        /**
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {{files: ({}}}
         */
        browserify: function(bundle, file) {
            return files({
                [path.javascript(bundle, 'public', file)]: path.javascript(bundle, 'private', file)
            });
        },
        /**
         * @param {string} task
         * @param {string} bundle
         * @param {string} file
         *
         * @returns {{files: (string[]),tasks: string[]}}
         */
        watchStyle: function(task, bundle, file) {
            var configuration = files([
                path.scss(bundle, file)
            ]);

            configuration.tasks = tasks(task, ['sass', 'postcss']);

            return configuration;
        },
        /**
         * @param task
         * @param bundle
         * @param file
         *
         * @returns {{files: (string[]),tasks: string[]}}
         */
        watchScript: function(task, bundle, file) {
            var configuration = files([
                path.javascript(bundle, 'private', file)
            ]);

            configuration.tasks = tasks(task, ['browserify', 'uglify']);

            return configuration;
        }
    };

    /**
     * @param {string} bundle
     */
    function registerBundle(bundle) {

        console.log('registerBundle : ' + bundle + 'Bundle');

        const SCRIPT = 'SCRIPT';
        const STYLE = 'STYLE';

        /**
         * @param file
         * @param callback
         *
         * @returns {{style: builder.style, script: builder.script, addWatch: builder.addWatch}}
         */
        function registerTaskFor(file, callback) {
            var task = bundle + '_' + file;

            callback(task);

            return builder;
        }

        var last_watch = {
            type: undefined,
            reference: undefined
        };

        // Register imagemin
        registerTaskFor('image_global', function(task) {
            gruntConfiguration.imagemin[task] = {
                files: [{
                    expand: true,
                    cwd: path.images(bundle, 'private'),
                    src: ['**/*.{png,jpg,gif}'],
                    dest: path.images(bundle, 'public')
                }]
            };

            gruntConfiguration.watch[task] = {
                files: [
                    path.images(bundle, 'private') + '**.*'
                ],
                tasks: ['imagemin:' + task]
            }
        });

        /**
         * @type {{style: builder.style, script: builder.script, addWatch: builder.addWatch}}
         */
        var builder = {
            style: function(file) {
                return registerTaskFor(file, function(task) {

                    // Register style tasks
                    gruntConfiguration.sass[task] = configuration.sass(bundle, file);
                    gruntConfiguration.postcss[task] = configuration.postcss(bundle, file);
                    gruntConfiguration.watch[task + '_style'] = configuration.watchStyle(task, bundle, file);

                    // Store last watch for addWatch
                    last_watch.type = STYLE;
                    last_watch.reference = gruntConfiguration.watch[task + '_style'];
                });
            },
            script: function(file) {
                return registerTaskFor(file, function(task) {

                    // Register script tasks
                    gruntConfiguration.browserify[task] = configuration.browserify(bundle, file);
                    gruntConfiguration.uglify[task] = configuration.uglify(bundle, file);
                    gruntConfiguration.watch[task + '_script'] = configuration.watchScript(task, bundle, file);

                    // Store last watch for addWatch
                    last_watch.type = SCRIPT;
                    last_watch.reference = gruntConfiguration.watch[task + '_script'];
                });
            },
            addWatch: function(callback) {

                // Throw warn error if no last_watch
                if (void 0 === last_watch.type) {
                    grunt.fail.warn('You must register a style or a script before adding a watch');
                }

                // Available types
                var types = {
                    [SCRIPT]: Array.prototype.push.bind(last_watch.reference.files, ...callback(function(file) {
                        return path.javascript(bundle, 'private', file)
                    })),
                    [STYLE]: Array.prototype.push.bind(last_watch.reference.files, ...callback(function(file) {
                        return path.scss(bundle, file)
                    }))
                };

                // Throw fatal error if not available type
                (types[last_watch.type] || function() {
                    grunt.fail.fatal('Undefined last_watch type in addWatch');
                })();

                return builder;
            }
        };

        return builder;
    }

    grunt.task.registerTask('symfony', 'Symfony bundle assets helper', function(command, option) {
        function runAllTasks(skipWatch) {
            var index, tasks = Object.keys(gruntConfiguration);

            if (skipWatch && (index = tasks.indexOf('watch')) !== -1) {
                tasks.splice(index);
            }

            grunt.task.run(tasks);
        }

        // Default task
        if (arguments.length === 0) {
            return runAllTasks()
        }

        // Available commands
        var commands = {
            dump: function() {
                var dump = JSON.stringify(gruntConfiguration, function(key, value) {
                    return 'options' === key ? undefined : value;
                }, 'formatted' === option ? '\t' : '');

                grunt.file.write('grunt.symfony.dump.json', dump)
            },
            assets: runAllTasks.bind(null, true)
        };

        // Throw fatal error on undefined command
        (commands[command] || function() {
            grunt.fail.warn(command + ' is not a valid command')
        })()
    });

    return {
        get: function() {
            return gruntConfiguration;
        },
        register: function(callback) {
            callback(registerBundle);
        }
    }
};
