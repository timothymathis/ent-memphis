Health and Medical WordPress Theme
===
_WPlook Studio WordPress theme_

Health and Medical WordPress Theme is a simple and clean but still professional WordPress theme that is best suited for Health and Medical WordPress Theme Organizations, NGO (Non-governmental organizations), foundations, churches, political organizations etc.

Information for developers
---
Health and Medical WordPress Theme uses the [Grunt](http://gruntjs.com) task runner to automate the theme editing process and [Bower](http://bower.io) to manage the JavaScript software included with the theme. In this case, Grunt compiles the SASS files into CSS usable by browsers and copies the JavaScript and font files from Bower into the theme's assets directory. Let's go through how this works step by step.

### Installing Grunt and Bower

Both Grunt and Bower depend on npm, the Node.js package manager. You'll need to [download npm](https://nodejs.org/en/download/) and install it, but you don't need to worry about it once it's installed.

The first time you use Grunt and Bower, you'll need to install them. Open the terminal/command prompt on your system and run:
```
npm install -g bower grunt-cli
```

Then, for every project you work on (such as this theme), you need to navigate to the base directory of the theme in the terminal/command prompt and run:
```
npm install
```

This command will install all the things necessary to get started with Grunt and Bower. Before you start editing the theme, you also need Bower to download all the necessary files relating to JavaScript libraries, fonts etc. To do this, run the following in the current directory of the theme:

```
bower install
```

Both Bower and npm know what to install thanks to the `bower.json` and `package.json` files included with the theme.

### Using Grunt and Bower

You can run Grunt using the following command in the current directory of the theme:
```
grunt
```

By default, this does the following things:
* Compiles the SASS files in `src/sass/` into `style.css`
* Compiles the SASS admin styles in `src/sass/admin.scss` into `assets/css/admin.css/`
* Analyses the new `style.css` and adds any vendor prefixes which might be needed
* Generates source maps, which means that if you inspect an element in your browser's web developer tools, they will reference the location in the SASS files, rather than the outputted CSS
* Makes a copy of style.css and splits it into ie.css files (look at `inc/headerdata.php` for an explanation of this behaviour)
* Copies the downloaded files from Bower into `assets/`

It then runs a watch task, which means it will wait for you to edit and save files in `src/sass/`, and when you do, it will compile them automatically. This means you don't have to run Grunt every time after you edit a file.

### Using SASS

SASS is basically a supercharged version of CSS. You can find out more about the [benefits of SASS](http://sass-lang.com), and particularly check out the [SASS reference](http://sass-lang.com/guide) for a quick look at what you can do with SASS over basic CSS.

### Copying files to your server

Bower and npm create the large `bower_components` and `node_modules` folders containing a lot more than the theme requires. All that is needed is copied from those directories into theme directories by grunt, so you don't have to upload these two directories when you upload the theme files to your server.
