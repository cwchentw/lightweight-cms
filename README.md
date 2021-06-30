# Markdown Content Management System

mdcms (Markdown Content Management System) is a Markdown-based dynamic website generator powered by PHP.

## Warning

mdcms is still experimental.

## Why not another Static Site Generator?

There have been more than enough static site generators currently. It is not ideal to reinvent one more wheel. Therefore, we create a dynamic one.

Website owners prefer flat files over relational databases. Nonetheless, static sites are suboptimal for some types of websites, like a membership site or a mix of a blog and web application. mdcms combines the best of two worlds - PHP-powered dynamic websites with Markdown files as contents.

## System Requirements

### Back End

* Production
  * GNU/Linux is recommended
  * A web server like Apache or Nginx
  * PHP 7.3 or above
  * FastCGI Process Manager (FPM) of PHP
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
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
  * Node.js
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)
  * [ESLint](https://eslint.org/)

The dependencies mentioned here are based on *default* theme of mdcms. If you adapt another theme, your dependencies of the Web may vary.

## Usage

We assume GNU/Linux as both development and production environments. If you use Windows, see [this article](/content/howto/how-to-run-mdcms-on-windows.md).

Clone the repo locally:

```
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to root path of the cloned repo:

```
$ cd mysite
```

(Optional) Install Composer:

```
$ ./tools/bin/install-composer $HOME/bin
```

Install dependencies of mdcms with Composer:

```
$ composer install --no-dev
```

If you don't want to update your mdcms snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your mdcms copy, follow [this guide](/content/howto/how-to-upgrade-mdcms.md).

You can run a mdcms site locally with builtin web server of PHP:

```
$ sudo ./tools/bin/serve
```

[Deploy](/content/deployment.md) the cloned repo to a web hosting service supporting PHP 7.3 or above:

```
$ sudo ./tools/bin/sync-to /path/to/www
```

If you modify anything locally, repeat the above command to update your change(s) in a production environment.

Set the configuration of a web server accordingly. [Here](/tools/etc/nginx.conf) is a sample Nginx configuration to run mdcms sites.

(Optional) Save your local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Documentation

Visit our [official website](https://mdcms.org), which is a live demonstration of mdcms itself.

## Notes for PHP Developers

The website generator doesn't merely work as pseudo static websites. Instead, you may add more PHP scripts to *www* directory as needed. Furthermore, your scripts can share layouts and partials with other web pages in a mdcms site, reducing repeated code.

## Copyright

Copyright (c) 2021 Michelle Chen. Licensed under MIT
