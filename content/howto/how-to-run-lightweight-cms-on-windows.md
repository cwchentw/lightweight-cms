---
title: How to Run Lightweight CMS on Windows
linkTitle: Run Lightweight CMS on Windows
mtime: 2021/7/24
---

## Prologue

Most PHP-powered sites run on GNU/Linux. Lightweight CMS sites are of no exception. Nevertheless, some web programmers prefer Windows during development stage. This article illustrates steps to run Lightweight CMS on Windows.

## System Requirements

* Production environment
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

## Build a Development Environment for Lightweight CMS

### Install Command-Line Tools

Install [Chocolatey](https://chocolatey.org) first, which is a package manager for Windows used to install other software.

Install PHP:

```shell
> choco install php --version=8.1.7
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

Install `sed(1)` for Windows:

```shell
> choco install sed
```

(Optional) Install Perl from either [ActivePerl](https://www.activestate.com/products/perl/) or [Strawberry Perl](https://strawberryperl.com/).

### Install Laragon

Download installer of Laragon from its [official website](https://laragon.org). Doubly click the installer to install Laragon.

Select the lauguage shown during installation:

<p><img src="/img/howto/laragon-select-setup-language.png" alt="Select the language shown during Laragon installation" class="img-fluid" /></p>

Select destination location to install Laragon:

<p><img src="/img/howto/laragon-select-destination-location.png" alt="Select destination location to install Laragon" class="img-fluid" /></p>

Select additional settings if needed:

<p><img src="/img/howto/laragon-select-additional-settings.png" alt="Select additional settings to install Laragon" class="img-fluid" /></p>

We don't need these settings. Therefore, we unselect all.

Check all settings before install Laragon:

<p><img src="/img/howto/laragon-ready-to-install.png" alt="Select additional settings to install Laragon" class="img-fluid" /></p>

The installation is done:

<p><img src="/img/howto/laragon-completing-setup-wizard.png" alt="Select additional settings to install Laragon" class="img-fluid" /></p>

Enable required services:

<p><img src="/img/howto/laragon-set-services-and-ports.png" alt="Select additional settings to install Laragon" class="img-fluid" /></p>

We substitute Apache with Nginx here. If you don't need MySQL now, disable it temporarily.

You may encounter some warning from Windows Defender (a builtin firewall for Windows):

<p><img src="/img/howto/laragon-windows-defender-nginx.png" alt="Select additional settings to install Laragon" class="img-fluid" /></p>

Simply enable it. We don't use Laragon on production environments, stopping all services after development.

Set your Nginx configuration accordingly. [Here](https://github.com/cwchentw/lightweight-cms/blob/master/tools/etc/windows/nginx.conf) is a sample configuration.

## Usage

Clone Lightweight CMS locally and rename it:

```shell
> git clone https://github.com/cwchentw/lightweight-cms.git mysite
```

Change working directory to root path of the cloned repo:

```shell
> cd mysite
```

Install dependencies for Lightweight CMS:

```shell
> composer install --no-dev
```

Development tools like PHP Code Sniffer mean to lint code, which are not required to run Lightweight CMS.

If you don't want to update your Lightweight CMS snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your Lightweight CMS copy, follow [this guide](/howto/how-to-upgrade-mdcms/).

You can run a Lightweight CMS site locally with builtin web server of PHP:

```
$ .\tools\bin\serve.bat
```

Alternatively, if you want to simulate a production environment, copy your Lightweight CMS snapshot to Laragon document directory:

```shell
> .\tools\bin\sync-to.bat C:\Laragon\www\mdcms
```

If you alter anything in your Lightweight CMS site, repeat the above command to reflect your change on development environment.

(Optional) Save your Lightweight CMS repo to a remote site:

```shell
> git remote set-url origin https://example.com/user/mysite.git
> git push -u origin master
```
