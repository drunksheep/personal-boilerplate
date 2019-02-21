# personal-boilerplate

Based on  [Gulp](http://gulpjs.com/) with [Stylus](http://stylus-lang.com/) and [postCSS](http://postcss.org/).
Also uses [PHP](https://secure.php.net/) includes.

This version is made for [Wordpress]('https://wordpress.org') Theme Development.

So you should put this inside your themes folder, as it's own theme. and start from there.


**Features:**

 - CSS / JS Minifiers and concatenators
 - No more support for IE, only 11. 
 - Scripts for common web development issues (modals, carousels, smooth scrolling, etc) (Always a WIP)
 - Predefined CSS bases for development (Check defaults.styl)
 - Ready to use mixins (check mixins.styl)
 - CSS snippets to help development
 - Useful functions explained and ready to use in functions.php
 - Javascript utilities on helpers.js file

**How to use:**

    npm i

Will install all dependencies, then:

    gulp

 To run the default function (Starts stylus, creates/minifies CSS and JS files, watches for changes). 

You can also run specific functions: 

    gulp stylus // Runs stylus
    gulp css // Processes css on src folder 
    gulp compress // Concatenates and minifies JS files
    gulp-uglify-debug // accuses javascript errors more specifically

Since the files are .php you need a web server to run them, i recommend [XAMPP.](https://www.apachefriends.org/pt_br/index.html)

If you need help, contact me on [GitHub]('https://github.com/drunksheep')


## Changelog ##

**1.2**

- First "commited" version of the boilerplate. Reworked readme, folder structure, gulpfile and some of the JS/Stylus code snippets.

 **1.3** 

- Added Pump to dependencies and created a debug method for javascript on the gulpfile.
- Added some generic helper classes that i found myself rewriting in almost all projects, look for them on _defaults.styl_.
- Added some common font-sizes as variables on _variables.styl_.
- Fixed some bugs with folder structure creating 2 "main" files.
- Removed _images_ function until i can find a better alternative. 
- Removed useless JS bloating on main file that will come back when those tools are ready.

 **1.4** 

- JS tools are back!
- Removed useless mixins, added more useful snippets on _defaults.styl_
- ACTUALLY Fixed some bugs with folder structure creating 2 "main" files.
- Cleaned everything up a bit

**1.5** 

- Focusing on wordpress branch for now.
- Cleaned up functions.php, extra dumb files i forgot on src/stylus folders
- added some new JS, CSS and PHP snippets. 


