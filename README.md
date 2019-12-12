# personal-boilerplate

Based on  [Gulp](http://gulpjs.com/) with [Stylus](http://stylus-lang.com/) and [postCSS](http://postcss.org/).
Also uses [PHP](https://secure.php.net/) includes.


**Features:**

 - CSS / JS Minifiers and concatenators.
 - CSS Reset, pre-processor hierarchy guide, some useful classes (repeatables.styl), (WIP).
 - Babel to transpile ES6.
 - A easy to use structure for postcss modules.

**How to use:**

    npm install

Will install all dependencies, then:

    gulp

 To run the default function (Starts stylus, creates/minifies CSS and JS files, watches for changes).

You can also run specific functions:

    gulp js // Babel, Concat, Terse.
    gulp css // Stylus, post css modules.

Since the files are .php you need a web server to run them, i recommend [XAMPP](https://www.apachefriends.org/pt_br/index.html)


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

- Added [Babel]('https://babeljs.io/') to the Stack.
- Changed from _gulp-uglify_ to _gulp-terser_.
- Removed Old IE fallbacks (It's been enought time, right?)
- Restructured Gulpfile;

**1.6**
- Removed cssmqpacker module
- Updated dependency versions and fixed some conflicts
- Added some stuff that makes life easier on the .styl files