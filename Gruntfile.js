module.exports = grunt => {
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        /**DEV */
        compass: {
            dist: {
              options: {
                watch: true
              }
            }
        },

        image: {
            static: {
              options: {
                optipng: false,
                pngquant: true,
                zopflipng: true,
                jpegRecompress: false,
                mozjpeg: true,
                guetzli: false,
                gifsicle: true,
                svgo: true
              },
              files: {
                'img/img.png': 'src/img.png',
                'img/img.jpg': 'src/img.jpg',
                'img/img.gif': 'src/img.gif',
                'img/img.svg': 'src/img.svg'
              }
            },
            dynamic: {
              files: [{
                expand: true,
                cwd: 'src/',
                src: ['**/*.{png,jpg,gif,svg}'],
                dest: 'dist/'
              }]
            }
        },

        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        '*.php',
                        '*.html',
                        'css/*.css',
                        'img/*.png',
                        'img/*.jpg',
                        'js/*.js'
                    ]
                },
                options: {
                    proxy: '127.0.0.1/~panpan/mmi/bhind',
                    port: 8080,
                    watchTask: true,
                    notify: false
                }
                
                
            }
        },

        php: {
            dev: {
                options: {
                    port: 80,
                    base: '127.0.0.1/~panpan/mmi/bhind'
                }
            }
        }
    });

    // grunt.registerTask('default', []);
    grunt.registerTask('dev', [
        'php',
        'browserSync',
        'compass'
    ]);

    grunt.loadNpmTasks('grunt-image');
}