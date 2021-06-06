# mdcms (Markdown Content Management System)

A Markdown-based dynamic website generator powered by PHP.

## Warning

mdcms is still experimental.

## Why not another Static Site Generator?

There have been more than enough static site generators currently. It is not ideal to reinvent one more wheel. Therefore, we create a dynamic one.

Website owners prefer flat files over relational databases. Nonetheless, static sites are suboptimal for some types of websites, like a membership site or a mix of a blog and web application. mdcms combines the best of two worlds - a dynamic website with Markdown files as contents.

## System Requirements

### PHP

* Production
  * PHP 7.2 or above
  * mbstring extension of PHP
  * [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra)
  * [MetaParsedown](https://github.com/pagerange/metaparsedown)
* Development
  * [Composer](https://getcomposer.org)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org) (for linting)

### Web

* Production
  * A [modern browser](https://browsehappy.com) like Chrome or Firefox
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

## Usage

Clone the repo:

```
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to the root of the cloned repo:

```
$ cd mysite
```

On openSUSE, install the following packages before installing Composer:

```
$ sudo zypper install php7-openssl php7-phar php7-zlib
```

(Optional) Install Composer:

```
$ ./tools/bin/install-composer $HOME/bin
```

Install the dependencies of mdcms with Composer:

```
$ composer install --no-dev
```

Remove all sample posts in *content*, adding your awesome ones.

Deploy the cloned repo to a web hosting service supporting PHP 7.2 or above:

```
$ sudo ./tools/bin/sync-to /path/to/www
```

If you modify anything locally, repeat the above command to update your changes in a production environment.

Set the configuration of a web server accordingly. [Here](/tools/etc/nginx.conf) is a sample Nginx configuration.

(Optional) Save the local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Notes for PHP Developers

The website generator doesn't merely work as pseudo static websites. Instead, you may add more PHP scripts to *wwwroot* as needed. Furthermore, your scripts can share partials in *partials* with other web pages, reducing repeated code.

## See Also

The project is inspired by [Cristy94/markdown-blog](https://github.com/Cristy94/markdown-blog). Nonetheless, we don't copy and paste code from there but write everything from scratch.

## Copyright

Copyright (c) 2021, Michael Chen. Licensed under MIT
