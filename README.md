# Mix-up
A Starter Theme for Genesis Child Themes

This is the ultimate Genesis starter theme based on Bourbon and Neat. Since we're using Bourbon you absolutely will positively be Sassified with the options [Bourbon](http://bourbon.io) and [Neat](http://neat.bourbon.io) provide you. We know we were!

## First Things First

In order to properly use this starter theme we're going to rely on some build scripts to be installed. We're going to need the following installed on your machine:
* Node
* Sass
* Composor

### Installing Node
If you've never used Node or Sass on your machine before you're going to have to install those first. Installing Node.js is very straight forward. Just head to the [Node](https://nodejs.org) site and install whatever package you need based on whether you're running Linux, Mac or Windows.

### Installing Sass
Next up, you'll need to install Sass. Installing Sass is just as straightforward as installing Node. Go ahead and visit the [Sass site](http://sass-lang.com/install) and you'll receive instructions on how to install Sass on your particular machine.

### Installing Composor
We're using Composor to include external depencies in our Fortytwo project, but you might want to consider to install Composer globally on your machine. Instructions on how to do that can be found [here](https://getcomposer.org/doc/00-intro.md#globally). By installing Composer globally you'll be able to use it on any next project that includes Composor as well.

## Next steps

With Node and Sass installed we can go ahead and actually start using this most awesome Genesis starter theme. We're going to assume you have a local server environment set up and a development site ready to go.

### Cloning Fortytwo

Go ahead and clone this repository into a folder name of your choosing in `wp-content/themes/`. If you'd like to do that straight from the command line you can use the following line of code once you've navigated to the before menioned themes folder:
```
git clone git@github.com:ThemeMix/fortytwo.git theme-folder-name
```
where `theme-folder-name` obviously is the part you can change to match your project.

### Install Gulpjs, Bower and Dependencies
Now that we have our project started (cloned) we can get this thing going. We're going to need to install Gulpjs and bower on a per project basis. In other words, you'll need to run the following steps on each of your projects, going forward.

* *Install Gulp* — Open a command prompt/terminal and navigate to your theme's root directory and run this command: `npm install` - This installs all the necessary Gulp plugins to help with task automation such as Sass compiling and browser-sync!

* *Install Bower* – In the command prompt/terminal run this command: `npm install -g bower`. This installs Bower (the `-g` flag installs globally, not just in the current directory). Your only need to do this step once.

* *Install Bower Dependencies* - There are Sass and Js packages that are required by Fortyto. To get them run this command: `bower install` - This command will install the theme's dependencies such as bourbon, neat, flexnav etc.

* *Install Composer Dependencies* - The only Composer Dependency setup at this time is PHPCS w/ WordPress Coding Standards. This allows us to run a Gulp task to "sniff" out any code in your theme that isn't standards-compliant. You can then go back and fix the offending code. The PHPCS task in `gulpfile.js` can be configured to included/exclude any directory within your theme. By default, it looks at php files in theme-root and files within the page-templates directory.

Once you have completed the Composer install, you should be able to run the following command to install PHPCS: `php composer.phar install`.
You can update the composer file via `sudo composer self-update command.

## Gulp Tasks

There are a couple of tasks built into Fortytwo to help get you going.

* `gulp` This command simply starts up Gulp and watches your scss, js and php filder for changes, writes them out and refreshes the browser for you.

* `gulp build` This command removes unneccessary files and packs up the required files into a nice and neat, installable, zip package. Honestly, this is here because I was uploading my theme to the WP.org uploader so many times... Epitome of the laze.

Each task such as `js`, `images` or `browser-sync` may be started individually. Although, the only one of them you'd do that with is the `images` task since that's not auto-optimizing at the moment.

##Theme Development, Minification and You

When developing your theme note that the output style.css file and production.js file are in expanded (readable) format if `WP_DEBUG` is set to true in `wp-config.php`. If `WP_DEBUG` is NOT set to true, then style.css and production.js are minified for you. While developing your theme, I recommend that `WP_DEBUG` is set to true. Just a good practice anyway.

A Note About Javascript Files - If you have JS files that are not managed by Bower, you should place those files inside the `assets/js/app` folder. Why? Gulp runs a task that concatenates js files in that directory and checks them for errors, which is pretty nifty. You can modify Gulp task behavior to suit your tastes, of course.

Extra Note! If you've set `WP Debug` true, the concatenated file is unminified and if set to false, then the concatenated file is minified. If you don't intend to use this functionality, you should comment-out or remove the lines referring to `development.js` and `production-min.js`.

### Props

* Graciously borrowed content from [Digisavvy](https://github.com/digisavvy/some-like-it-neat) repo.

