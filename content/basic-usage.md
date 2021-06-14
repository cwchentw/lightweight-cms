# Basic Usage of mdcms

## Prologue

This article illustrates the basic usage of mdcms. Some details are omitted for brevity. We will introduce them in other posts.

## System Requirements

### Back End

* Production environment
  * GNU/Linux
  * A web server like Apache or Nginx
  * PHP 7.2 or above
  * FastCGI Process Manager (FPM) of PHP
  * mbstring extension of PHP
  * [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra)
  * [MetaParsedown](https://github.com/pagerange/metaparsedown)
* Development environment
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org/) (for linting)

We develop mdcms on openSUSE Leap mostly. Any major GNU/Linux distribution should suffice to host a mdcms site.

If you are not interested in developing mdcms itself, you still require Composer to install other dependency packages for mdcms.

### Front End

* Production environment
  * A [modern browser](https://browsehappy.com/) like Chrome and Firefox
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

Currently, we utilize Sass as CSS preprocessor and Babel with Flow as JavaScript transcompiler. If you prefer other front end stacks over our choices, you may completely remove these development tools and configurations, adding your own. They are independent of mdcms itself.

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

Install the dependency packages for mdcms:

```
$ composer install --no-dev
```

Remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Deploy the cloned repo to a web hosting service supporting PHP 7.2 or above:

```
$ sudo ./tools/bin/sync-to /path/to/www
```

If you modify anything locally, repeat the command to update your change in a production environment.

Set the configuration of a web server accordingly. [Here](https://github.com/cwchentw/mdcms/blob/master/tools/etc/nginx.conf) is a sample Nginx configuration.

(Optional) Save the local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Usage for Theme Creators

(Pending)

## Usage for Plugin Developers

(Pending)

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

Modify mdcms in any way you like as long as it still runs smoothly. You don't require to remove sample posts in *content* directory. In contrary, they serve as ready sample data to see whether your changes work.

You should lint your modification with the following script:

```
$ ./tools/bin/lint
```

The script calls PHP Code Sniffer and PHPMD with modified rule sets. Our coding convention is not totally set yet.

Push back your modification to the forked repo:

```
$ git push https://github.com/user/mdcms.git
```

Send us a pull request. We will review your code, merging it if proper. Even your code is not accepted, we may still modify mdcms according to your intention.

If you are busy, send us [an issue](https://github.com/cwchentw/mdcms/issues) instead.
