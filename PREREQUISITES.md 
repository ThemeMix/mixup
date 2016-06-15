### Installing Node
If you've never used Node or Sass on your machine before you're going to have to install those first. Installing Node.js is very straight forward. Just head to the [Node](https://nodejs.org) site and install whatever package you need based on whether you're running Linux, Mac or Windows.

### Installing Sass
Next up, you'll need to install Sass. Installing Sass is just as straightforward as installing Node. Go ahead and visit the [Sass site](http://sass-lang.com/install) and you'll receive instructions on how to install Sass on your particular machine.

### Installing Composor
We're using Composor to include external depencies in our MixUp project, but you might want to consider to install Composer globally on your machine. Instructions on how to do that can be found [here](https://getcomposer.org/doc/00-intro.md#globally). By installing Composer globally you'll be able to use it on any next project that includes Composor as well.

### Install Gulpjs, Bower and Dependencies
Now that we have our project started (cloned) we can get this thing going. We're going to need to install Gulpjs and bower on a per project basis. In other words, you'll need to run the following steps on each of your projects, going forward.

* *Install Gulp* — Open a command prompt/terminal and navigate to your theme's root directory and run this command: `npm install` - This installs all the necessary Gulp plugins to help with task automation such as Sass compiling and browser-sync!

* *Install Bower* – In the command prompt/terminal run this command: `npm install -g bower`. This installs Bower (the `-g` flag installs globally, not just in the current directory). Your only need to do this step once.

* *Install Bower Dependencies* - There are Sass and Js packages that are required by MixUp. To get them run this command: `bower install` - This command will install the theme's dependencies such as bourbon, neat, flexnav etc.

* *Install Composer Dependencies* - The only Composer Dependency setup at this time is PHPCS w/ WordPress Coding Standards. This allows us to run a Gulp task to "sniff" out any code in your theme that isn't standards-compliant. You can then go back and fix the offending code. The PHPCS task in `gulpfile.js` can be configured to included/exclude any directory within your theme. By default, it looks at php files in theme-root and files within the page-templates directory.

Once you have completed the Composer install, you should be able to run the following command to install PHPCS: `php composer.phar install`.
You can update the composer file via `sudo composer self-update command.