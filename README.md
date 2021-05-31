# mdcms

Markdown-based content management system powered by PHP.

## System Requirements

### PHP

* Production
  * PHP 7.2 or above
  * mbstring extension of PHP
  * [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra)
* Development
  * [Composer](https://getcomposer.org)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (only for linting)
  * [PHPMD](https://phpmd.org) (only for linting)

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
$ ./scripts/install-composer $HOME/bin
```

Install dependencies with Composer:

```
$ composer install
```

(Optional) Install the dependencies related to web development with Node.js:

```
$ npm install
```

If you don't require to write CSS or JavaScript, skip the step.

Remove all sample posts in *content*, adding your awesome ones.

(Optional) Build assets for production environments:

```
$ npm run prod
```

Deploy the cloned repo to a web hosting service supporting PHP 7:

```
$ sudo ./scripts/sync-to /path/to/www
```

If you update your local repo, repeat the command to update the code in your production environment.

Set the configuration of the web server accordingly. [Here](/scripts/nginx.conf) is a sample Nginx configuration.

(Optional) Save the local repo to another remote repo:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## Notes for PHP Developers

This CMS doesn't merely work as pseudo static websites. Instead, you may add more PHP scripts to *wwwroot* as needed. Furthermore, your scripts can share partials in *partials* with other pages, reducing repeated code.

## See Also

The project is inspired by [Cristy94/markdown-blog](https://github.com/Cristy94/markdown-blog). Nonetheless, we don't copy and paste code from there but write everything from scratch.

## Copyright

Copyright (c) 2021, Michael Chen. Licensed under MIT
