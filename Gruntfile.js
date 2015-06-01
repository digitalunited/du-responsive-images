'use strict';
module.exports = function (grunt) {
    // Load all tasks
    require('load-grunt-tasks')(grunt);
    // Show elapsed time
    require('time-grunt')(grunt);

    var jsFileList = [
        'assets/vendor/lazysizes/plugins/bgset/ls.bgset.js',
        'assets/vendor/lazysizes/lazysizes.js',
        'assets/vendor/lazysizes/plugins/respimg/ls.respimg.js',
        'assets/js/_*.js'
    ];

    grunt.initConfig({
        less: {
            dev: {
                files: {
                    'assets/css/main.css': [
                        'assets/less/main.less'
                    ]
                },
                options: {
                    compress: false,
                    sourceMap: true
                }
            },
            build: {
                files: {
                    'assets/css/main.css': [
                        'assets/less/main.less'
                    ]
                },
                options: {
                    compress: true
                }
            }
        },
        concat: {
            dist: {
                options: {
                    separator: ';'
                },
                src: [jsFileList],
                dest: 'assets/js/scripts.min.js'
            }
        },
        uglify: {
            dist: {
                files: {
                    'assets/js/scripts.min.js': [jsFileList]
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
            },
            dev: {
                options: {
                    map: {
                        prev: 'assets/css/'
                    }
                },
                src: 'assets/css/main.css'
            },
            build: {
                src: 'assets/css/main.css'
            }
        },
        watch: {
            less: {
                files: [
                    'assets/less/*.less',
                    'assets/less/**/*.less',
                ],
                tasks: ['less:dev', 'autoprefixer:dev']
            },
            js: {
                files: [
                    jsFileList
                ],
                tasks: ['concat']
            },
            livereload: {
                port: 1337,
                options: {
                    livereload: true
                },
                files: [
                    'assets/**/*.less',
                    'assets/css/main.css',
                    'assets/js/scripts.js',
                    '**/*.php'
                ]
            }
        }
    });

    // Register tasks
    grunt.registerTask('default', [
        'dev',
        'watch'
    ]);
    grunt.registerTask('dev', [
        'less:dev',
        'autoprefixer:dev',
        'concat:dist'
    ]);
    grunt.registerTask('build', [
        'less:build',
        'autoprefixer:build',
        'uglify'
    ]);
};
