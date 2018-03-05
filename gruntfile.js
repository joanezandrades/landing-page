module.exports = function ( grunt ) {

    // Configurações dos plugins
    grunt.initConfig({
        /* Limpa os arquivos */
        clean: {
            css: ['css/main-style.css', 'css/configs.css']
        },

        /* Compila .sass -> .css */
        sass: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'css',
                    src: ['main-style.sass', 'configs.sass'],
                    dest: 'css',
                    ext: '.css'
                }],
                style: 'compressed'
            }
        },

        /* Minifica css */
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'css',
                    src: ['*.css', '!*.min.css'],
                    dest: 'css',
                    ext: '.min.css'
                }]
            }
        }

    });

    // Carregar plugins
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Registrar tarefas
    grunt.registerTask( 'default', ['clean', 'sass'] );
}