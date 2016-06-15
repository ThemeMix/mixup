# MixUp
A Starter Theme for Genesis Child Themes

This is the ultimate Genesis starter theme based on Bourbon and Neat. Since we're using Bourbon you absolutely will positively be Sassified with the options [Bourbon](http://bourbon.io) and [Neat](http://neat.bourbon.io) provide you. We know we were!

## First Things First

In order to properly use this starter theme we're going to rely on some build scripts to be installed. We're going to need the following installed on your machine:
* Node
* Sass
* Composor

If you still need to do this, go read about how to install the [prerequisites](https://github.com/ThemeMix/MixUp/blob/master/PREREQUISITES.md) first.

## Next steps

With Node and Sass installed we can go ahead and actually start using this most awesome Genesis starter theme. We're going to assume you have a local server environment set up and a development site ready to go.

### Cloning MixUp

Go ahead and clone this repository into a folder name of your choosing in `wp-content/themes/`. If you'd like to do that straight from the command line you can use the following line of code once you've navigated to the before menioned themes folder:
```
git clone git@github.com:ThemeMix/MixUp.git theme-folder-name
```
where `theme-folder-name` obviously is the part you can change to match your project.

## Gulp Tasks

There are a couple of tasks built into MixUp to help get you going.

* `gulp` This command simply starts up Gulp and watches your scss, js and php filder for changes, writes them out and refreshes the browser for you.

* `gulp build` This command removes unneccessary files and packs up the required files into a nice and neat, installable, zip package.

Each task such as `js`, `images` or `browser-sync` may be started individually. Although, the only one of them you'd do that with is the `images` task since that's not auto-optimizing at the moment.

##Theme Development, Minification and You

When developing your theme note that the output style.css file and production.js file are in expanded (readable) format if `WP_DEBUG` is set to true in `wp-config.php`. If `WP_DEBUG` is NOT set to true, then style.css and production.js are minified for you. While developing your theme, We recommend that `WP_DEBUG` is set to true. Just a good practice anyway.

A Note About Javascript Files - If you have JS files that are not managed by Bower, you should place those files inside the `assets/js/app` folder. Why? Gulp runs a task that concatenates js files in that directory and checks them for errors, which is pretty nifty. You can modify Gulp task behavior to suit your tastes, of course.

Extra Note! If you've set `WP Debug` true, the concatenated file is unminified and if set to false, then the concatenated file is minified. If you don't intend to use this functionality, you should comment-out or remove the lines referring to `development.js` and `production-min.js`.

### Props

* Graciously borrowed content from [Digisavvy](https://github.com/digisavvy/some-like-it-neat) repo.

