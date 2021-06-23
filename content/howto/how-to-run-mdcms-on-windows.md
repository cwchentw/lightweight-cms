---
title: How to Run a mdcms Site on Windows
mtime: 2021/6/23
---

## Prologue

Pending.

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

```shell
> choco install php --version=7.4.20
```

```shell
> choco install composer
```

```shell
> choco install rsync
```

### Install MAMP

Pending.

## Usage

```shell
> git clone https://github.com/cwchentw/mdcms.git mysite
```

```shell
> cd mysite
```

```shell
> composer install --no-dev
```

```shell
> .\tools\bin\sync-to.bat C:\MAMP\mdcms
```

```shell
> git remote set-url origin https://example.com/user/mysite.git
> git push -u origin master
```
