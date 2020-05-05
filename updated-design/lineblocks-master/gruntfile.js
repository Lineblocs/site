module.exports = function (grunt) {

	grunt.initConfig({
		sass: {
			options: {
				sourceMap: true,
				style: 'minify',
			},
			dist: {
				files: {
					'css/custom.css': 'sass/custom.scss'
				}
			}
		},
		watch: {
			css: {
				files: ['**/*.scss'],
				tasks: ['sass']
			},
			html: {
				files: [
					'app/*.html',
					'includes/*.html',
				],
				tasks: ['bake:build']
			}
		},
		bake: {
			build: {
				files: {
					'login.html': 'app/login.html',
					'signup.html': 'app/signup.html',
					'verification.html': 'app/verification.html',
					'index.html': 'app/index.html',
					'color-header.html': 'app/color-header.html',
					'service.html': 'app/service.html'
					// 'profile.html': 'app/profile.html',
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-htmlmin');
	grunt.loadNpmTasks("grunt-bake");
	grunt.task.run([
		'bake:build'
	]);
	require('load-grunt-tasks')(grunt);

	grunt.registerTask('default', ['sass', 'watch', 'bake:build']);

};
