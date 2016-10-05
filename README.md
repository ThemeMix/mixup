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


### Props

* [Genesis Sample](https://github.com/copyblogger/genesis-sample) from StudioPress.
* [Genesis Sample](https://github.com/gregrickaby/genesis-sample) from Greg Rickaby.
* Graciously borrowed content from [Digisavvy](https://github.com/digisavvy/some-like-it-neat).

