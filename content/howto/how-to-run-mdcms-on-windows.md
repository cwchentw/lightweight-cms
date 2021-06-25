---
title: How to Run mdcms Sites on Windows
mtime: 2021/6/23
---

## Prologue

Most PHP-powered sites run on GNU/Linux. mdcms sites are of no exception. Nevertheless, some web programmers prefer Windows during development stage. This article illustrates steps to run mdcms sites on Windows.

## System Requirements

* Production environment
  * A web server like Apache or Nginx
  * PHP 7.2 or above
  * FastCGI Process Manager (FPM) of PHP
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
  * (Optional) Perl (for global replacement)
* Development environment
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org/) (for linting)

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

## Build a Development Environment for mdcms

### Install Command-Line Tools

Install [Chocolatey](https://chocolatey.org) first, which is a package manager for Windows used to install other software.

Install PHP:

```shell
> choco install php --version=7.4.20
```

At time of our writing, many GNU/Linux distributions still provide PHP 7 rather than PHP 8. Therefore, we install PHP 7 intentionally.

Install Composer, a package manager for PHP:

```shell
> choco install composer
```

Install `rsync(1)` for Windows:

```shell
> choco install rsync
```

### Install Laragon

MAMP shows some welcome message on startup:

<img src="/img/howto/mamp-welcome.png" alt="Welcome message of MAMP installer" class="img-fluid" />

Set your Nginx configuration accordingly. [Here](https://github.com/cwchentw/mdcms/blob/master/tools/etc/windows/nginx.conf) is a sample configuration.

## Usage

Clone mdcms locally and rename it:

```shell
> git clone https://github.com/cwchentw/mdcms.git mysite
```

Change working directory to root path of the cloned repo:

```shell
> cd mysite
```

Install dependencies for mdcms:

```shell
> composer install --no-dev
```

Development tools like PHP Code Sniffer mean to lint code, which are not required to run mdcms sites.

If you don't want to update your mdcms snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your mdcms copy, follow [this guide](/howto/how-to-upgrade-mdcms/).

Copy your mdcms snapshot to Laragon document directory:

```shell
> .\tools\bin\sync-to.bat C:\Laragon\www\mdcms
```

If you alter anything in your mdcms site, you have to repeat the above command to reflect your change on development environment.

(Optional) Save your mdcms repo to a remote site:

```shell
> git remote set-url origin https://example.com/user/mysite.git
> git push -u origin master
```
