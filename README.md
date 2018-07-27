# personal-boilerplate

Based on [Gulp](http://gulpjs.com/) with [Stylus](http://stylus-lang.com/) and [postCSS](http://postcss.org/).
Also uses [PHP](https://secure.php.net/) includes.


**Features:**

 - Gulpfile ready to run
 - CSS / JS Minifiers and concatenators
 - IE Conditionals (IE9+) support
 - Scripts for common web development issues (modals, carousels, smooth scrolling, etc) (Always a WIP)
 - Predefined CSS bases for development (Check defaults.styl)
 - @font-face mixin (check mixins.styl) 

**How to use:**

    npm install

Will install all dependencies, then:

    gulp

 To run the default function (Starts stylus, creates/minifies CSS and JS files, watches for changes). 

You can also run specific functions: 

    gulp stylus // Runs stylus
    gulp css // Processes css on src folder 
    gulp compress // Concatenates and minifies JS files
    gulp-uglify-debug // accuses javascript errors more specifically

Since the files are .php you need a web server to run them, i recommend [EasyPHP.](http://www.easyphp.org/)


If you need help, contact me on [GitHub]('https://github.com/drunksheep')


## Changelog ##

**1.0**

- First boilerplate version that has been made with wordpress in mind. pardon my french.