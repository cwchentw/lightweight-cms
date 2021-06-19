---
title: Basic Usage of mdcms
mtime: 2021/6/19
weight: 2
---

## Prologue

This article illustrates basic usage of mdcms. Some details are omitted for brevity. We will introduce them in other posts.

## System Requirements

### Back End

* Production environment
  * GNU/Linux
  * A web server like Apache or Nginx
  * PHP 7.2 or above
  * FastCGI Process Manager (FPM) of PHP
  * [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra)
  * [MetaParsedown](https://github.com/pagerange/metaparsedown)
  * [yaml-front-matter](https://github.com/spatie/yaml-front-matter)
* Development environment
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org/) (for linting)

We develop mdcms on openSUSE Leap mostly. Any major GNU/Linux distribution should suffice to host a mdcms site.

If you are not interested in developing mdcms itself, you still require Composer to install other dependency packages for mdcms.

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
  * [ESLint](https://eslint.org/)

These dependencies are for *default* theme of mdcms. If you utilize another mdcms theme, your dependencies may vary.

Currently, we utilize Sass as CSS preprocessor and Babel with Flow as JavaScript transcompiler. If you prefer other front end stacks over our choices, you may completely remove those, adding your own. They are independent of mdcms itself.

## Usage for End Users

You are a would-be owner of an awesome content website. It is not of your interest to develop mdcms itself.

Clone mdcms to a local repo and rename it:

```shell
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to the root of the cloned repo:

```shell
$ cd mysite
```

(Optional) Install Composer:

```shell
$ ./tools/bin/install-composer path/to/prefix
```

By default, this shell script will install Composer to *$HOME/bin* with the name `composer`.

Install dependency packages for mdcms:

```
$ composer install --no-dev
```

If you don't want to update your mdcms snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your mdcms copy, follow [this guide](/howto/how-to-update-mdcms/).

Deploy the cloned repo to a web hosting service supporting PHP 7.2 or above:

```
$ sudo ./tools/bin/sync-to /path/to/www
```

Internally, the script calls `rsync(1)` to synchronize your mdcms site on a production environment. Therefore, you may set your target path to a remote server.

If you modify anything locally, repeat the command to update your change(s) in a production environment.

Set configuration of a web server accordingly. [Here](https://github.com/cwchentw/mdcms/blob/master/tools/etc/nginx.conf) is a sample Nginx configuration to run a mdcms site.

(Optional) Save the local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Usage for Theme Creators

You should create an independent repo for your mdcms theme. Follow [this guide](/howto/how-to-create-mdcms-theme/) to create a theme.

Assume your mdcms theme is ready. Add your theme to your mdcms copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/mytheme.git themes/mytheme
```

Later, update your change(s) to your mdcms repo if any:

```
$ git submodule update
```

## Usage for Plugin Developers

You should create an independent repo for your mdcms plugin.

Assume your mdcms plugin is ready. Add your plugin to your mdcms copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myplugin.git plugins/myplugin
```

Later, update your change(s) to your mdcms repo if any:

```
$ git submodule update
```

## Usage for Contributors

You, as a PHP programmer, are interested in developing mdcms itself. You may keep your modifications privately or send back your contributions to us.

Create a fork of mdcms on GitHub, clone the forked repo:

```shell
$ git clone https://github.com/user/mdcms.git
```

Change your working directory to the root of the cloned repo:

```shell
$ cd mdcms
```

Install all dependencies with Composer:

```
$ composer install
```

Modify mdcms in any way you like as long as it still runs smoothly. You don't require to remove any post in *content* directory. They serve as sample data to see whether your change(s) work.

You should lint your modification with the following script:

```
$ ./tools/bin/lint
```

The script calls both PHP Code Sniffer and PHPMD with modified rule sets. Our coding convention is not totally set yet.

Push back your modification(s) to the forked repo:

```
$ git push https://github.com/user/mdcms.git
```

Send us a pull request. We will review your code, merging it if proper. Even your code is not accepted, we may still modify mdcms according to your intention.

If you are busy, send us [an issue](https://github.com/cwchentw/mdcms/issues) instead.
