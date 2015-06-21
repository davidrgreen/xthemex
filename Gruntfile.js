module.exports = function(grunt) {
	//grunt.file.setBase('../');

	//Load plugins Just in Time/as needed (increases speed)
	require('jit-grunt')(grunt);

	grunt.initConfig ({
		autoprefixer: {
			dev: {
				options: {
					browsers: [
						'Android >= 2.1',
						'Chrome >= 21',
						'Explorer >= 8',
						'Firefox >= 17',
						'Opera >= 12.1',
						'Safari >= 6.0'
					]
				},
				files: {
					'assets/css/style.min.css': 'assets/css/style.css'
				}
			}
		},
		browserSync: {
			dev: {
				bsFiles: {
					src: [
						'assets/css/style.css',
						'assets/img/*',
						'assets/js/theme.js',
						'**/*.php',
						'!**/node_modules/**'
					]
				},
				options: {
					notify: false,
					open: false,
					proxy: 'xsiteaddressx.dev',
					/*port: 8123,*/
					ui: false,
					watchTask: true
				}
			}
		},
		concat: {
			dev: {
				src: [
					'assets/js/partials/*.js',
					'assets/js/vendor/*.js'
				],
				dest: 'assets/js/theme.js'
				}
		},
		cssmin: {
			dev: {
				src: 'assets/css/style.css',
				dest: 'assets/css/style.min.css',
				options: {
					keepSpecialComments: 1
				}
			}
		},
		imagemin: {
			themeimg: {
				files: [{
					expand: true,
					cwd: 'assets/img-raw/',
					src: ['**/*.{png,jpg,gif}'],
					dest: 'assets/img/'
				}]
			},
			tempimg: {
				files: [{
					expand: true,
					cwd: 'assets/img-temp-raw/',
					src: ['**/*.{png,jpg,gif}'],
					dest: 'assets/img-temp/'
				}]
			}
		},
		jshint: {
			beforeconcat: {
				src: [
					'assets/js/partials/*.js',
					'assets/js/vendor/*.js'
				],
				options: {
					"node": true,
					"esnext": true,
					"curly": false,
					"smarttabs": true,
					"globals": {
						"jQuery": true
					}
				}
			},
			afterconcat: {
				src: [
					'assets/js/theme.js'
				],
				options: {
					"node": true,
					"esnext": true,
					"curly": false,
					"smarttabs": true,
					/*"quotmark": "single",*/
					"globals": {
						"jQuery": true
					}
				}
			}
		},
		uglify: {
			options: {
				mangle: false
			},
			my_target: {
				files: {
					'assets/js/theme.min.js': 'assets/js/theme.js'
				}
			}
		},
		watch: {
			css: {
				files: [
				'assets/css/style.css'
				],
				tasks: ['autoprefixer:dev', 'cssmin:dev']
			},
			concat: {
				files: ['assets/js/partials/*.js', 'assets/js/vendor/*.js'],
				tasks: ['concat']
			},
			afterconcat: {
				files: ['assets/js/theme.js'],
				tasks: ['uglify']
			},
			img: {
				files: ['assets/img-raw/*.{png,jpg,gif}'],
				tasks: ['newer:imagemin:themeimg']
			},
			tempimg: {
				files: ['assets/img-temp-raw/*.{png,jpg,gif}'],
				tasks: ['newer:imagemin:tempimg']
			}
		}

	});

	grunt.registerTask( 'default', ['browserSync:dev', 'watch'] );
	grunt.registerTask( 'optimize', ['newer:autoprefixer:dev', 'newer:cssmin:dev', 'newer:uglify', 'newer:imagemin'] );
	grunt.registerTask( 'css', ['autoprefixer:dev', 'cssmin:dev'] );
	grunt.registerTask( 'js', ['concat:dev', 'uglify'] );
}
