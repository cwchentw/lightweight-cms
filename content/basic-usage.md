---
title: Basic Usage of Lightweight CMS
mtime: 2022/07/20
weight: 2
---

## Prologue

This article illustrates basic usage of Lightweight CMS. Some details are omitted for brevity. We will introduce them in other posts.

## System Requirements

### Back End

* Production environment
  * GNU/Linux is recommended
  * A web server like Apache or Nginx
  * PHP 8.1
  * FastCGI Process Manager (FPM) of PHP
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
  * (Optional) AsciiDoctor (for AsciiDoc support)
  * (Optional) Docutils (for reStructuredText support). Pygments (code highlighting for reStructuredText)
  * (Optional) Perl (for global replacement)
* Development environment
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org/) (for linting)

Any major GNU/Linux distro should suffice to host a Lightweight CMS site.

If you are not interested in developing Lightweight CMS itself, you still require Composer to install other dependency packages for Lightweight CMS.

### Front End

* Production environment
  * A [modern browser](https://browsehappy.com/) like Chrome and Firefox
  * [Normalize.css](https://necolas.github.io/normalize.css/)
  * [Bootstrap 5](https://getbootstrap.com/)
  * [Bootstrap.Native](https://thednp.github.io/bootstrap.native/)
  * (Optional) [highlight.js](https://highlightjs.org/)
* Development environment
  * Node.js
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)

These dependencies are for *default* theme of Lightweight CMS. If you utilize another Lightweight CMS theme, your dependencies may vary.

Currently, we utilize Sass as CSS preprocessor and Babel with Flow as JavaScript transcompiler. If you prefer other front end stacks over our choices, you may completely remove those, adding your own. They are independent of Lightweight CMS itself.

## Usage for End Users

We assume GNU/Linux as both development and production environments. If you use Windows, see [this article](/howto/how-to-run-mdcms-on-windows/).

You are a would-be owner of an awesome content website. It is not of your interest to develop Lightweight CMS itself.

Clone Lightweight CMS to a local repo and rename it:

```shell
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to root path of the cloned repo:

```shell
$ cd mysite
```

(Optional) Install Composer:

```shell
$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
```

By default, this shell script will install Composer to *$HOME/bin* with the name `composer`.

Install dependency packages for Lightweight CMS:

```
$ composer install --no-dev
```

If you don't want to update your Lightweight CMS snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your Lightweight CMS copy, follow [this guide](/howto/how-to-upgrade-mdcms/).

You can run a Lightweight CMS site locally with builtin web server of PHP:

```
$ sudo ./tools/bin/serve
```

[Deploy](/deployment/) the cloned repo to a web hosting service supporting PHP 8.1:

```
$ sudo ./tools/bin/sync-to /path/to/www
```

Internally, the script calls `rsync(1)` to synchronize your Lightweight CMS site on a production environment. Therefore, you may set your target path to a remote server.

If you modify anything locally, repeat the command to update your change(s) in a production environment.

Set configuration of a web server accordingly. [Here](https://github.com/cwchentw/mdcms/blob/master/tools/etc/nginx.conf) is a sample Nginx configuration to run a Lightweight CMS site.

(Optional) Save the local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Usage for Theme Creators

You should create an independent repo for your Lightweight CMS theme. Follow [this guide](/howto/how-to-create-mdcms-theme/) to create a theme.

Assume your Lightweight CMS theme is ready. Add your theme to your Lightweight CMS copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myTheme.git themes/myTheme
```

Later, initialize and update your change(s) to your Lightweight CMS repo if any:

```
$ git submodule init
$ git submodule update
```

## Usage for Plugin Developers

You should create an independent repo for your Lightweight CMS plugin.

Assume your Lightweight CMS plugin is ready. Add your plugin to your Lightweight copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myPlugin.git plugins/myPlugin
```

Later, initialize and update your change(s) to your Lightweight CMS repo if any:

```
$ git submodule init
$ git submodule update
```

## Usage for Contributors

You, as a PHP programmer, are interested in developing Lightweight CMS itself. You may keep your modifications privately or send back your contributions to us.

Create a fork of Lightweight CMS on GitHub, cloning the forked repo:

```shell
$ git clone https://github.com/user/mdcms.git
```

Change your working directory to root path of the cloned repo:

```shell
$ cd mdcms
```

Install all dependencies with Composer:

```
$ composer install
```

Modify Lightweight CMS in any way you like as long as it still runs smoothly. You don't require to remove any post in *content* directory. They serve as sample data to see whether your change(s) work.

You should lint your modification with the following script:

```
$ ./tools/bin/lint
```

The script calls both PHP Code Sniffer and PHPMD with modified rule sets. Our coding convention is not totally set yet.

Push back your modification(s) to the forked repo:

```
$ git push https://github.com/user/mdcms.git
```

Send us a pull request. We will review your code, merging it if proper. Even your code is not accepted, we may still modify Lightweight CMS according to your intention.

If you are busy, open [a dicussion](https://github.com/cwchentw/mdcms/discussions) or send us [an issue](https://github.com/cwchentw/mdcms/issues) instead.
