module.exports = function(grunt) {
    grunt.initConfig({
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 8', 'ie 9']
            },
            main: {
                expand: true,
                flatten: true,
                src: 'web/css/*.css',
                dest: 'web/css/'
            }
        },
    });
    

    grunt.registerTask('default', ['revizor', 'autoprefixer']);

    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-revizor');
    grunt.loadNpmTasks('grunt-contrib-watch');
}