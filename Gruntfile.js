'use strict';

module.exports = function(grunt) {
    // Load plugins
    require('load-grunt-tasks')(grunt);

    var path = require('path'),
        fs = require('fs');

    /* jshint camelcase:false */
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            assets: ['www/assets/*', '!www/assets/.gitignore']
        },
        kss: {
            options: {
                includeType: 'less',
                includePath: 'less/main.less'
            },
            dist: {
                files: {
                    'www/styleguide': ['less']
                }
            }
        },
        less: {
            theme: {
                files: {
                    'assets/main.css': 'less/main.less'
                }
            }
        },
        less_imports: {
            options: {
                inlineCSS: false
            },
            dist: {
                dest: 'less/app.less',
                src: [
                    'less/mixins/**/*.less',
                    'less/layouts/**/*.less',
                    'less/partials/**/*.less',
                    'less/common/**/*.less',
                    'less/controllers/**/*.less',
                    'less/widgets/**/*.less',
                    'less/responsive/**/*.less'
                ]
            }
        },
        watch: {
            styles: {
                files: ['less/**/*.less'],
                tasks: ['less', 'less_imports', 'clean:assets'],
                options: {
                    spawn: false
                }
            }
        }
    });

    // Define tasks
    grunt.registerTask('default', ['clean:assets', 'less', 'less_imports', 'watch']);
};
