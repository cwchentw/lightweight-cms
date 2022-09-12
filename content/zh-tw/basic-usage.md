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
* 開發環境
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (語法檢查)
  * [PHPMD](https://phpmd.org/) (語法檢查)

主流 GNU/Linux 發行版應該足以托管 Lightweight CMS 網站。

即使你對開發 Lightweight CMS 本身沒興趣，你仍然需要 Composer 以安裝 Lightweight CMS 的相依套件。

### 前端

* 生產環境
  * [現代瀏覽器](https://browsehappy.com/)，像是 Chrome 和 Firefox
  * [Normalize.css](https://necolas.github.io/normalize.css/)
  * [Bootstrap 5](https://getbootstrap.com/)
  * [Bootstrap.Native](https://thednp.github.io/bootstrap.native/)
  * (可選擇) [highlight.js](https://highlightjs.org/)
* 開發環境
  * [Node.js](https://nodejs.org/)
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)

這裡的相依套件是是根據 *default* 和 *multilingual* 佈景主題而定。如果你使用另一個佈景主題，你的前端相依性可能會不同。

目前我們使用 Sass 做為 CSS 前處理器和 Babel 加上 Flow 做為 JavaScript 轉譯器。如果你偏好其他前端技術，你可以移除我們的前端編譯腳本，加上你自己的。這些腳本和 Lightweight CMS 本身是獨立的。

## 一般使用者的用法

我們認定 GNU/Linux 同時為開發環境和生產環境。如果你使用 Windows，請看這篇[指引](/zh-tw/howto/run-lightweight-cms-on-windows/)。

你將成為一個令人讚嘆的內容型網站的擁有者。開發 Lightweight CMS 本身不符合你的興趣。

拷貝 Lightweight CMS 到本地端並將其改名：

```shell
$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
```

將工作目錄移到該專案的根目錄：

```shell
$ cd mysite
```

安裝 Composer：

```shell
$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
$ rm -f composer-setup.php
```

在預設情形下，這些指令將 Composer 安裝到 *$HOME/bin* ，其指令名為 `composer`。

安裝 Lightweight CMS 的相依套件：

```shell
$ composer install --no-dev
```

若你不想更新 Lightweight CMS 網站，你可以移除 *content* 目錄內所有範例文章，但不要移除該目錄本身，然後加上你自己的文章。

相對來說，若你想要更新 Lightweight CMS 網站，請看這篇[指引](/zh-tw/howto/upgrade-lightweight-cms/)。

你可以用 PHP 內建網頁伺服器在本地端運行 Lightweight CMS 網站：

```shell
$ sudo ./tools/bin/serve
```

[發佈](/zh-tw/deployment/)該專案到支援 PHP 8.1 以上的網站托管服務：

```shell
$ sudo ./tools/bin/sync-to /path/to/www
```

該腳本內部呼叫 `rsync(1)` 來同步本地端的 Lightweight CMS 網站到生產環境。因此，你可以將目標路徑設到遠端主機。

若你更動了本地端，重覆上述指令，將修改更新到生產環境上。

根據你的環境設置網頁伺服器。[這裡](https://github.com/cwchentw/lightweight-cms/blob/master/tools/etc/nginx.conf)是一份執行 Lightweight CMS 網站的範例 Nginx 設定檔。

(可選擇的) 將本地端專案存到遠端專案托管平台：

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

## 佈景主題製作者的用法

你應該為佈景主題建立獨立的專案。參考這份[指引](/zh-tw/howto/create-lightweight-cms-theme/)來建立佈景主題。

Assume your Lightweight CMS theme is ready. Add your theme to your Lightweight CMS copy as a Git submodule:

```shell
$ git submodule add https://example.com/user/myTheme.git themes/myTheme
```

Later, initialize and update your change(s) to your Lightweight CMS repo if any:

```shell
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
