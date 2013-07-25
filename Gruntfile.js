module.exports = function(grunt) {
 
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
     
    // Define our source and build folders
    js_src_path: 'public/js',
    js_build_path: "js",
    css_src_path: "public/css",
    css_build_path: "css",
 
    // Grunt Tasks
    concat: {
      options:{
        separator: ';'
      },
      js: {
        src: ['<%= js_src_path %>/*.js'],
        dest: '<%= js_build_path %>/app.js'
      },
      css:{
        src: ['<%= css_src_path %>/*.css'],
        dest: '<%= css_build_path %>/app.css'   
      }
    },
    uglify: {
      options:{
        mangle: true,
        banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version + "\\n" %>' +
        '* <%= grunt.template.today("yyyy-mm-dd") + "\\n" %>' +
        '* <%= pkg.homepage + "\\n" %>' + 
        '* Copyright (c) <%= grunt.template.today("yyyy") %> - <%= pkg.title %> */ <%= "\\n" %>'
      },
      js: {
        src: '<%= concat.js.dest %>',
        dest:'<%= js_build_path %>/app.min.js'
      }
    },
    cssmin: {
      css: {
        src: '<%= concat.css.dest %>',
        dest:'<%= css_build_path %>/app.min.css'
      }
    }
  });
   
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
 
  // Default task.
  grunt.registerTask('default', ['concat', 'uglify', 'cssmin']);
};
