# Lightweight CMS

Dual-mode, flat-file CMS powered by PHP

## Features

* Cross-platform
* Use vanilla PHP as its core and template language, which is well known by virtually all web developers
* Switch between a static site and PHP dynamic website
* Build a multilingual site
* Write posts in either [Markdown](https://github.github.com/gfm/), [AsciiDoc](https://asciidoc.org/), [reStructuredText](https://docutils.sourceforge.io/rst.html) or vanilla HTML
* Write dynamic pages in PHP
* Draft posts
* Nested sections
* Breadcrumb
* Pagination
* Table of Contents
* Interlinked tags
* Image lazy loading
* No following external links for SEO
* Sitemap generator
* RSS feed generator
* Progressive Web Application
* Asset compilation
* Asset watching and hot change(s)

## Synopsis

### Windows

```shell
> choco install php --version=8.1.21
> choco install composer
> choco install nodejs --version=18.17.0
> choco install rsync
> choco install sed
```

```shell
> git clone https://github.com/cwchentw/lightweight-cms.git mysite
> cd mysite
> git checkout master
> .\tools\bin\serve.bat
```

```shell
> git remote set-url origin https://example.com/user/mysite.git
> .\tools\bin\migrate.bat
> git add .
> git commit -m "Migrate to a new site"
> git push -u origin master
```

### macOS

```shell
$ brew install php@8.1
$ brew install composer
$ brew install node@18
```

```shell
$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
$ cd mysite
$ git checkout master
$ ./tools/bin/serve
```

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ ./tools/bin/migrate
$ git add .
$ git commit -m "Migrate to a new site"
$ git push -u origin master
```

### Ubuntu

```shell
$ sudo apt install php php-xml php-mbstring php-zip unzip
```

```shell
$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
```

Install [nvm](https://github.com/nvm-sh/nvm). Install Node.js with `nvm`:

```shell
$ nvm install 18.17.0
$ nvm use 18.17.0
```

```shell
$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
$ cd mysite
$ git checkout master
$ ./tools/bin/serve
```

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ ./tools/bin/migrate
$ git add .
$ git commit -m "Migrate to a new site"
$ git push -u origin master
```

## Why not simply another Static Site Generator?

There have been more than enough static site generators currently. It is unbeneficial to reinvent one more wheel. Therefore, we create a flat-file CMS capable to switch between a static website and a dynamic one.

Website owners prefer flat files over relational databases when feasible. Nonetheless, static sites are suboptimal for some sorts of websites, like a membership site or a mix of a content site and web application. Lightweight CMS combines the best of two worlds - PHP-powered dynamic websites with flat-file posts written in popular lightweight markup languages.

## System Requirements

### Back End

* Production
  * GNU/Linux is recommended
  * A web server like Apache or Nginx
  * PHP 8.0 or 8.1
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
  * (Optional) AsciiDoctor (for AsciiDoc support)
  * (Optional) Docutils (for reStructuredText support). Pygments (code highlighting for reStructuredText)
  * (Optional) Perl (for global replacement)
* Development
  * [Composer](https://getcomposer.org)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org) (for linting)

### Front End

* Production
  * A [modern browser](https://browsehappy.com) like Chrome or Firefox
  * [Normalize.css](https://necolas.github.io/normalize.css/)
  * [Bootstrap 5](https://getbootstrap.com)
  * [Bootstrap.Native](https://thednp.github.io/bootstrap.native/)
  * (Optional) [highlight.js](https://highlightjs.org)
* Development
  * Node.js 18.x
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)

The dependencies mentioned here are based on *default* and *multilingual* themes of Lightweight CMS. If you adapt another theme, your dependencies of the Web may vary.

## Builtin Themes

* *default* theme for documentation sites
* *multilingual* theme for documentation sites with multiple locales
* *blog* theme for blogs

Set `SITE_STYLE` in *config/optionalFeatures.php* or its template to `blog` if you employ *blog* theme or its equivalent; to `documentation` otherwise.

## Usage

We assume GNU/Linux as both development and production environments. If you use Windows, see [this article](https://lightweightcms.org/howto/run-lightweight-cms-on-windows/).

Clone the repo locally:

```shell
$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
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

Install dependencies of Lightweight CMS with Composer:

```shell
$ composer install --no-dev
```

If you don't want to update your Lightweight CMS snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your Lightweight CMS copy, follow [this guide](https://lightweightcms.org/howto/upgrade-lightweight-cms/).

You can run a Lightweight CMS site locally with builtin web server of PHP:

```shell
$ ./tools/bin/serve
```

[Deploy](https://lightweightcms.org/deployment/) the cloned repo to a web hosting service supporting PHP 8.0 or 8.1:

```shell
$ sudo ./tools/bin/sync-to /path/to/www
```

If you modify anything locally, repeat the above command to update your change(s) in a production environment.

Set the configuration of a web server accordingly. [Here](/tools/etc/nginx.conf) is a sample Nginx configuration to run Lightweight CMS sites.

(Optional) Save your local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Breaking Changes

See [here](/CHANGELOG.md)

## Copyright

Copyright (c) 2023 ByteBard. Licensed under MIT
