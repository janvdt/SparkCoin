module.exports = function (grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			dev: { // Development Builds
				options: {
					banner				: '/* Development Build - <%= grunt.template.today() %> */',
					preserveComments	: true,
					mangle				: false
				},
				files: {
					'js/min/min.modernizr.js' 	: 'js/modernizr/*.js',
					'js/min/min.plugins.js'		: 'js/plugins/*.js',
					'js/min/min.custom.js'		: 'js/custom/*.js'
				}
			},
			prod: { // Production Builds
				options: {
					banner : '/* Production Build - <%= grunt.template.today() %> */',
					compress: {
						drop_console: true
					},
					mangle: true
				},
				files: {
					'js/min/mangle.modernizr.js' 	: 'js/modernizr/*.js',
					'js/min/mangle.plugins.js'		: 'js/plugins/*.js',
					'js/min/mangle.custom.js'		: 'js/custom/*.js'
				}
			}
		},
		sass: {
			dist: {
				options: {
					banner	 : '/* Distribution Build - <%= grunt.template.today() %> */',
					style		 : 'compressed',
					debugInfo : true,
					trace		 : true,
					require	 : 'sass-globbing'
				},
				files: {
					'css/app.css' : 'sass/app.scss'
				}
			}
		},
		watch: {
			scripts: {
				files	: [
					'js/modernizr/*.js',
					'js/plugins/*.js',
					'js/custom/*.js',
				],
				tasks: ['uglify']
			},
			sass: {
				files	: [
					'sass/*.scss'
				],
				tasks: ['sass']
			}
		}
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');

	// Register tasks
	grunt.registerTask('default', ['watch']);

}