---
title: 基本用法
mtime: 2022/09/11
weight: 2
---

## 前言

本文說明 Lightweight CMS 的基本用法。為了節約篇幅，略去一些細節。我們會在其他文章介紹這些內容。

## 系統需求

### 後端

* 生產環境
  * 建議使用 GNU/Linux
  * 網頁伺服器，像是 [Apache](https://httpd.apache.org/) 或 [Nginx](https://www.nginx.com/)
  * [PHP 8.1](https://www.php.net/) 以上的版本
  * PHP 的 FastCGI 行程管理器
  * [FrontYAML](https://github.com/mnapoli/FrontYAML)
  * (可選擇) [AsciiDoctor](https://asciidoctor.org/) (AsciiDoc 支援)
  * (可選擇) [Docutils](https://docutils.sourceforge.io/) (reStructuredText 支援)。[Pygments](https://pygments.org/) (在 reStructuredText 使用語法高亮)
  * (可選擇) [Perl](https://www.perl.org/) (全域替換)
* 生產環境
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (語法檢查)
  * [PHPMD](https://phpmd.org/) (語法檢查)

主流 GNU/Linux 發行版應該足以托管 Lightweight CMS 網站。

即使你對開發 Lightweight CMS 本身沒興趣，你仍然需要 Composer 以安裝 Lightweight CMS 的相依套件。

### 前端

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

These dependencies are for *default* theme of Lightweight CMS. If you utilize another Lightweight CMS theme, your dependencies may vary.

Currently, we utilize Sass as CSS preprocessor and Babel with Flow as JavaScript transcompiler. If you prefer other front end stacks over our choices, you may completely remove those, adding your own. They are independent of Lightweight CMS itself.

## 一般使用者的用法

We assume GNU/Linux as both development and production environments. If you use Windows, see [this article](/howto/how-to-run-lightweight-cms-on-windows/).

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
```

By default, this shell script will install Composer to *$HOME/bin* with the name `composer`.

Install the dependency packages for Lightweight CMS:

```
$ composer install --no-dev
```

If you don't want to update your Lightweight CMS snapshot, you may safely remove all sample posts in *content* directory but not the directory itself, adding your awesome ones.

Instead, if you are going to update your Lightweight CMS copy, follow [this guide](/howto/how-to-upgrade-lightweight-cms/).

You can run a Lightweight CMS site locally with the builtin web server of PHP:

```
$ sudo ./tools/bin/serve
```

[Deploy](/deployment/) the cloned repo to a web hosting service supporting PHP 8.1 or above:

```
$ sudo ./tools/bin/sync-to /path/to/www
```

Internally, the script calls `rsync(1)` to synchronize your Lightweight CMS site on a production environment. Therefore, you may set your target path to a remote server.

If you modify anything locally, repeat the command to update your change(s) in a production environment.

Set configuration of a web server accordingly. [Here](https://github.com/cwchentw/lightweight-cms/blob/master/tools/etc/nginx.conf) is a sample Nginx configuration to run a Lightweight CMS site.

(Optional) Save the local repo to a remote site:

```
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## 佈景主題製作者的用法

You should create an independent repo for your Lightweight CMS theme. Follow [this guide](/howto/how-to-create-lightweight-cms-theme/) to create a theme.

Assume your Lightweight CMS theme is ready. Add your theme to your Lightweight CMS copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myTheme.git themes/myTheme
```

Later, initialize and update your change(s) to your Lightweight CMS repo if any:

```
$ git submodule init
$ git submodule update
```

## 外掛製作者的用法

You should create an independent repo for your Lightweight CMS plugin.

Assume your Lightweight CMS plugin is ready. Add your plugin to your Lightweight copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myPlugin.git plugins/myPlugin
```

Later, initialize and update your change(s) to your Lightweight CMS repo if any:

```
$ git submodule init
$ git submodule update
```

## 專案貢獻者的用法

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

```
$ composer install
```

Modify Lightweight CMS in any way you like as long as it still runs smoothly. You don't require to remove any post in *content* directory. They serve as sample data to see whether your change(s) work.

You should lint your modification with the following script:

```
$ ./tools/bin/lint
```

The script calls both PHP Code Sniffer and PHPMD with modified rule sets. Our coding convention is not totally set yet.

Push back your modification(s) to the forked repo:

```
$ git push https://github.com/user/lightweight-cms.git
```

Send us a [pull request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/about-pull-requests). We will review your code, merging it if proper. Even your code is not accepted, we may still modify Lightweight CMS according to your intention.

If you are busy, open [a dicussion](https://github.com/cwchentw/lightweight-cms/discussions) or send us [an issue](https://github.com/cwchentw/lightweight-cms/issues) instead.

## 網站翻譯者的用法

Lightweight CMS is a multilingual site currently, open to the translations for the site text of Lightweight CMS. If you want to translate the site text to a new locale, send us a pull request related to the locale or request the locate related code on GitHub [dicussion](https://github.com/cwchentw/lightweight-cms/discussions).

By default, Lightweight CMS supports `ltr` (left-to-right) scripts. The support to `rtl` scripts is an open issue.
