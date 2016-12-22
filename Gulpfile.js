// Require our dependencies
var autoprefixer = require('autoprefixer');
var bourbon = require('bourbon').includePaths;
var browserSync = require('browser-sync');
var cheerio = require('gulp-cheerio');
var concat = require('gulp-concat');
var csscomb = require('gulp-csscomb');
var cssnano = require('gulp-cssnano');
var del = require('del');
var gulp = require('gulp');
var debug = require('gulp-debug');
var gutil = require('gulp-util');
var imagemin = require('gulp-imagemin');
var mqpacker = require('css-mqpacker');
var neat = require('bourbon-neat').includePaths;
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var postcss = require('gulp-postcss');
var reload = browserSync.reload;
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var sassLint = require('gulp-sass-lint');
var sort = require('gulp-sort');
var sourcemaps = require('gulp-sourcemaps');
var spritesmith = require('gulp.spritesmith');
var svgmin = require('gulp-svgmin');
var svgstore = require('gulp-svgstore');
var uglify = require('gulp-uglify');
var wpPot = require('gulp-wp-pot');
var runSequence = require('run-sequence');
var stylelint = require('stylelint');
var configWordPress = require('stylelint-config-wordpress');

// Set assets paths.
var paths = {
    css: ['./*.css', '!*.min.css'],
    icons: 'images/svg-icons/*.svg',
    images: ['images/*', '!images/*.svg'],
    php: ['./*.php', './**/*.php'],
    sass: 'sass/**/*.scss',
    sass_path: 'sass/',
    temp_path: 'temp/',
    concat_scripts: 'js/concat/*.js',
    scripts: ['js/*.js', '!js/*.min.js', '!js/responsive-menu.js'],
    sprites: 'images/sprites/*.png'
};

// Sass Files to be treated as Parse and Minify (keep comments)
var sassFilesToParseAndMinify = [
    'vendors/normalize'
]


// Browsers you care about for autoprefixing.
// Browserlist https://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
    'last 2 version',
    '> 1%',
    'ie >= 9',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'
];

/**
 * Handle errors and alert the user.
 */
function handleErrors () {
    var args = Array.prototype.slice.call(arguments);

    notify.onError({
        title: 'Task Failed [<%= error.message %>',
        message: 'See console.',
        sound: 'Sosumi' // See: https://github.com/mikaelbr/node-notifier#all-notification-options-with-their-defaults
    }).apply(this, args);

    gutil.beep(); // Beep 'sosumi' again

    // Prevent the 'watch' task from stopping
    this.emit('end');
}

/**
 * Map Array of Sass Parse and Minify treated Files and return to function
 */
function outputSassFilesToParseAndMinify() {
    var returnValue = []; // Array in which mapped values will be returned

    sassFilesToParseAndMinify.map(function(element, index ) {
        returnValue.push(paths.sass_path + element + ".scss");
    });

    return returnValue;
}

/**
 * Extract only the filesname from the parsed array of sass files
 */
function extractFilesFromSassParsed() {
    var returnValue = []; // Array in which mapped values will be returned

    sassFilesToParseAndMinify.map(function(element) {
        var lastPart = element.split("/").pop();
        var cssFullPath = paths.temp_path + lastPart + ".css"

        returnValue.push( cssFullPath );
    });

    returnValue.unshift(paths.temp_path + "style.css");
    returnValue.push(paths.temp_path + "main.css");

    return returnValue;
}



/**
 * Debug task
 */
gulp.task('debug', function () {
    return gulp.src(extractFilesFromSassParsed())
        .pipe(debug({title: 'ParseAndMinify Variable Name:'}));
});


/**
 * Delete style.css and style.min.css before we minify and optimize
 */
gulp.task('clean:style', function() {
    return del(['style.css', 'style.min.css'])
});


/**
 * Delete scripts before we concat and minify
 */
gulp.task('clean:scripts', function() {
    return del(['js/script.js', 'js/script.min.js']);
});


/**
 * Delete the svg-icons.svg before we minify, concat
 */
gulp.task('clean:icons', function() {
    return del(['images/svg-icons.svg']);
});


/**
 * Delete temp folder
 */
gulp.task('clean:temp', function() {
    return del(paths.temp_path)
});


/**
 * Delete the theme's .pot before we create a new one
 */
gulp.task('clean:pot', function() {
    return del(['languages/mixup.pot']);
});



/**
 * Compile Normalize sass to css.
 *
 * https://www.npmjs.com/package/gulp-sass
 * https://www.npmjs.com/package/gulp-postcss
 */
gulp.task('compilecss:sassfilestoparseandminify', function() {
    return gulp.src(outputSassFilesToParseAndMinify(), paths.css)

    // Deal with errors.
        .pipe(plumber({ errorHandler: handleErrors }))

        // Compile Sass to css using LibSass.
        .pipe(sass({
            outputStyle: 'compressed' // Options: nested, expanded, compact, compressed
        }))

        // Remove inline comments and minify with cssnano
        .pipe(cssnano({
            discardComments:  true
        }))

        // Gulp Debug
        // .pipe(debug({title: 'Output file at Task compilecss:sassfilestoparseandminify:'}))

        // Create style.css.
        .pipe(gulp.dest('./temp/'))
        .pipe(browserSync.stream());
});



/**
 * Compile Style through sass to css
 *
 * https://www.npmjs.com/package/gulp-sass
 */
gulp.task(' ', function() {
    return gulp.src('sass/style.scss', paths.css)

    // Deal with errors.
        .pipe(plumber({ errorHandler: handleErrors }))

        // Compile Sass using LibSass.
        .pipe(sass({
            outputStyle: 'expanded' // Options: nested, expanded, compact, compressed
        }))

        // Gulp Debug
        // .pipe(debug({title: 'Output file at Task compilecss:style:'}))

        // Create style.css.
        .pipe(gulp.dest('./temp/'))
        .pipe(browserSync.stream());
});



/**
 * Compile Sass and run stylesheet through PostCSS.
 *
 * https://www.npmjs.com/package/gulp-sass
 * https://www.npmjs.com/package/gulp-postcss
 * https://www.npmjs.com/package/gulp-autoprefixer
 * https://www.npmjs.com/package/css-mqpacker
 */
gulp.task('compilecss:main', function() {
    return gulp.src('sass/main.scss', paths.css)

    // Deal with errors.
        .pipe(plumber({ errorHandler: handleErrors }))

        // Wrap tasks in a sourcemap.
        .pipe(sourcemaps.init())

        // Compile Sass using LibSass.
        .pipe(sass({
            includePaths: [].concat(bourbon, neat),
            errLogToConsole: true,
            outputStyle: 'expanded' // Options: nested, expanded, compact, compressed
        }))

        // CSS styling format based on Coding Standards
        .pipe(csscomb())

        // Parse with PostCSS plugins.
        .pipe(postcss([
            autoprefixer(AUTOPREFIXER_BROWSERS),
            mqpacker({
                sort: true
            }),
            stylelint(configWordPress) // use stylelint-config-wordpress
        ]))

        // Create sourcemap.
        .pipe(sourcemaps.write())

        // Create style.css.
        .pipe(gulp.dest(paths.temp_path))
        .pipe(browserSync.stream());
});


/**
 * Concatenate all css files to one file
 */
gulp.task('cssconcat', function(){
    // return gulp.src(['temp/style.css', 'temp/normalize.css', 'temp/fontawesome.css', 'temp/main.css'])
    return gulp.src(extractFilesFromSassParsed())
        .pipe(concat('style.css'))
        .pipe(gulp.dest('./'));
})


/**
 * Minify and optimize style.css.
 *
 * https://www.npmjs.com/package/gulp-cssnano
 */
gulp.task('cssnano', function() {
    return gulp.src('./style.css')
        .pipe(plumber({ errorHandler: handleErrors }))
        .pipe(cssnano({
            discardComments: {
                removeAll: true
            },
            safe: true // Use safe optimizations
        }))
        .pipe(rename('style.min.css'))
        .pipe(gulp.dest('./'))
        .pipe(browserSync.stream());
});

/**
 * Sass linting
 *
 * https://www.npmjs.com/package/sass-lint
 */
gulp.task('sass:lint', ['cssnano'], function() {
    gulp.src([
        'sass/**/*.scss',
        '!sass/defaults/_sprites.scss'
    ])
        .pipe(sassLint())
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError());
});


/**
 * Minify, concatenate, and clean SVG icons.
 *
 * https://www.npmjs.com/package/gulp-svgmin
 * https://www.npmjs.com/package/gulp-svgstore
 * https://www.npmjs.com/package/gulp-cheerio
 */
gulp.task('svg', ['clean:icons'], function() {
    return gulp.src(paths.icons)
        .pipe(plumber({ errorHandler: handleErrors }))
        .pipe(svgmin())
        .pipe(rename({ prefix: 'icon-' }))
        .pipe(svgstore({ inlineSvg: true }))
        .pipe(cheerio({
            run: function($, file) {
                $('svg').attr('style', 'display:none');
                $('[fill]').removeAttr('fill');
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(gulp.dest('images/'))
        .pipe(browserSync.stream());
});

/**
 * Optimize images.
 *
 * https://www.npmjs.com/package/gulp-imagemin
 */
gulp.task('imagemin', function() {
    return gulp.src(paths.images)
        .pipe(plumber({ errorHandler: handleErrors }))
        .pipe(imagemin({
            optimizationLevel: 5,
            progressive: true,
            interlaced: true
        }))
        .pipe(gulp.dest('images'));
});

/**
 * Concatenate images into a single PNG sprite.
 *
 * https://www.npmjs.com/package/gulp.spritesmith
 */
gulp.task('spritesmith', function() {
    return gulp.src(paths.sprites)
        .pipe(plumber({ errorHandler: handleErrors }))
        .pipe(spritesmith({
            imgName:   'sprites.png',
            cssName:   '../../sass/defaults/_sprites.scss',
            imgPath:   'images/sprites.png',
            algorithm: 'binary-tree'
        }))
        .pipe(gulp.dest('images/'))
        .pipe(browserSync.stream());
});


/**
 * Concatenate javascripts after they're clobbered.
 * https://www.npmjs.com/package/gulp-concat
 */
gulp.task('concat', ['clean:scripts'], function() {
    return gulp.src(paths.concat_scripts)
        .pipe(plumber({ errorHandler: handleErrors }))
        .pipe(sourcemaps.init())
        .pipe(concat('script.js'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('js'))
        .pipe(browserSync.stream());
});

/**
 * Minify javascripts after they're concatenated.
 * https://www.npmjs.com/package/gulp-uglify
 */
gulp.task('uglify', ['concat'], function() {
    return gulp.src(paths.scripts)
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify({
            mangle: false
        }))
        .pipe(gulp.dest('js'));
});


/**
 * Scan the theme and create a POT file.
 *
 * https://www.npmjs.com/package/gulp-wp-pot
 */
gulp.task('wp-pot', ['clean:pot'], function() {
    return gulp.src(paths.php)
        .pipe(plumber({ errorHandler: handleErrors }))
        .pipe(sort())
        .pipe(wpPot({
            domain: 'mixup',
            destFile:'mixup.pot',
            package: 'mixup',
            bugReport: 'https://thememix.com',
            lastTranslator: 'Translator <translations@thememix.com>',
            team: 'Translations Team <translations@thememix.com>'
        }))
        .pipe(gulp.dest('languages/'));
});

/**
 * Process tasks and reload browsers on file changes.
 *
 * https://www.npmjs.com/package/browser-sync
 */
gulp.task('watch', function() {

    // Kick off BrowserSync.
    browserSync({
        open: false,                  // Open project in a new tab?
        injectChanges: true,          // Auto inject changes instead of full reload
        proxy: "mixup.dev",  		  // Use http://mixup.dev:3000 to use BrowserSync
        watchOptions: {
            debounceDelay: 1000       // Wait 1 second before injecting
        }
    });

    // Run tasks when files change.
    gulp.watch(paths.icons, ['icons']);
    gulp.watch(paths.sass, function(){ runSequence('clean:style', 'compilecss:sassfilestoparseandminify', 'compilecss:style', 'compilecss:main', 'cssconcat', 'cssnano', 'clean:temp')} );
    gulp.watch(paths.scripts, ['scripts']);
    gulp.watch(paths.concat_scripts, ['scripts']);
    gulp.watch(paths.sprites, ['sprites']);
});

/**
 * Create individual tasks.
 */
gulp.task('i18n', ['wp-pot']);
gulp.task('icons', ['svg']);
gulp.task('scripts', ['uglify']);
gulp.task('styles', runSequence('clean:style', 'compilecss:sassfilestoparseandminify', 'compilecss:style', 'compilecss:main', 'cssconcat', 'cssnano', 'clean:temp'));
gulp.task('sprites', ['imagemin', 'spritesmith']);
gulp.task('default', ['i18n','icons', 'styles', 'scripts', 'sprites']);
