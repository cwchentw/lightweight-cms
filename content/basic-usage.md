---
title: Basic Usage
mtime: 2023/03/12
tags: ["Usage"]
weight: 2
---

## Prologue

This article illustrates the basic usage of Lightweight CMS. Some details are omitted for brevity. We will introduce them in other posts.

## System Requirements

### Back End

* Production environment
  * GNU/Linux is recommended
  * A web server like [Apache](https://httpd.apache.org/) or [Nginx](https://www.nginx.com/)
  * [PHP](https://www.php.net/) 8.0 or 8.1
  * FastCGI Process Manager (FPM) of PHP
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
  * (Optional) [AsciiDoctor](https://asciidoctor.org/) (for AsciiDoc support)
  * (Optional) [Docutils](https://docutils.sourceforge.io/) (for reStructuredText support). [Pygments](https://pygments.org/) (code highlighting in reStructuredText)
  * (Optional) [Perl](https://www.perl.org/) (for global replacement)
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
  * [Node.js](https://nodejs.org/)
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)

These dependencies are for *default* and *multilingual* themes of Lightweight CMS. If you utilize another Lightweight CMS theme, your dependencies may vary.

Currently, we utilize Sass as CSS preprocessor and Babel with Flow as JavaScript transcompiler. If you prefer other front end stacks over our choices, you may completely remove those, adding your own. They are independent of Lightweight CMS itself.

## Usage for End Users

We assume GNU/Linux as both development and production environments. If you use Windows, see [this article](/howto/run-lightweight-cms-on-windows/).

You are a would-be owner of an awesome content website. It is not of your interest to develop Lightweight CMS itself.

Clone Lightweight CMS to a local repo and rename it:

```shell
$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
```

Change your working directory to root path of the cloned repo:

```shell
$ cd mysite
```

Install Composer:

```shell
$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
$ rm -f composer-setup.php
```

By default, the commands will install Composer to *$HOME/bin* with the name `composer`.

Install the dependency packages for Lightweight CMS:

```shell
$ composer install --no-dev
```

If you don't want to update your Lightweight CMS snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your Lightweight CMS copy, follow [this guide](/howto/upgrade-lightweight-cms/).

You can run a Lightweight CMS site locally with the builtin web server of PHP:

```shell
$ sudo ./tools/bin/serve
```

[Deploy](/deployment/) the cloned repo to a web hosting service supporting PHP 8.0 or 8.1:

```shell
$ sudo ./tools/bin/sync-to /path/to/www
```

Internally, the script calls `rsync(1)` to synchronize your Lightweight CMS site on a production environment. Therefore, you may set your target path to a remote server.

If you modify anything locally, repeat the command to update your change(s) in a production environment.

Set configuration of a web server accordingly. [Here](https://github.com/cwchentw/lightweight-cms/blob/master/tools/etc/nginx.conf) is a sample Nginx configuration to run a Lightweight CMS site.

(Optional) Save the local repo to a remote site:

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Usage for Theme Creators

You should create an independent repo for your Lightweight CMS theme. Follow [this guide](/howto/create-lightweight-cms-theme/) to create a theme.

Assume your Lightweight CMS theme is ready. Add your theme to your Lightweight CMS copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myTheme.git themes/myTheme
```

Later, initialize and update your change(s) to your Lightweight CMS repo if any:

```shell
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

```shell
$ git submodule init
$ git submodule update
```

## Usage for Contributors

You, as a PHP programmer, are interested in developing Lightweight CMS itself. You may keep your modifications privately or send back your contributions to us.

Create a [fork](https://docs.github.com/en/get-started/quickstart/fork-a-repo) of Lightweight CMS on GitHub, cloning the forked repo:

```shell
$ git clone https://github.com/user/lightweight-cms.git
```

Change your working directory to root path of the cloned repo:

```shell
$ cd lightweight-cms
```

Install all dependencies with Composer:

```shell
$ composer install
```

Modify Lightweight CMS in any way you like as long as it still runs smoothly. You don't require to remove any post in *content* directory. They serve as sample data to see whether your change(s) work.

You should lint your modification with the following script:

```shell
$ ./tools/bin/lint
```

The script calls both PHP Code Sniffer and PHPMD with modified rule sets. Our coding convention is not totally set yet.

Push back your modification(s) to the forked repo:

```shell
$ git push https://github.com/user/lightweight-cms.git
```

Send us a [pull request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/about-pull-requests). We will review your code, merging it if proper. Even your code is not accepted, we may still modify Lightweight CMS according to your intention.

If you are busy, open [a dicussion](https://github.com/cwchentw/lightweight-cms/discussions) or send us [an issue](https://github.com/cwchentw/lightweight-cms/issues) instead.

## Usage for Translators

Lightweight CMS is a multilingual site currently, open to the translations for the site text of Lightweight CMS. If you want to translate the site text to a new locale, send us a pull request related to the locale or request the locate related code on GitHub [dicussion](https://github.com/cwchentw/lightweight-cms/discussions).

By default, Lightweight CMS supports `ltr` (left-to-right) scripts. The support to `rtl` scripts is an open issue.
