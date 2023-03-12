---
title: 基本用法
mtime: 2023/3/12
tags: ["使用"]
weight: 2
---

## 前言

本文說明 Lightweight CMS 的基本用法。為了節約篇幅，略去一些細節。我們會在其他文章介紹這些內容。

## 系統需求

### 後端

* 生產環境
  * 建議使用 GNU/Linux
  * 網頁伺服器，像是 [Apache](https://httpd.apache.org/) 或 [Nginx](https://www.nginx.com/)
  * [PHP](https://www.php.net/) 8.0 或 8.1
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

[發佈](/zh-tw/deployment/)該專案到支援 PHP 8.0 或 8.1 的網站托管服務：

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

假定你的 Lightweight CMS 佈景主題已經完成。將該佈景主題加入專案的 Git submodule：

```shell
$ git submodule add https://example.com/user/myTheme.git themes/myTheme
```

日後可將佈景主題的更動更新到專案中：

```shell
$ git submodule init
$ git submodule update
```

## 外掛製作者的用法

你應該為外掛建立獨立的專案。

假定你的 Lightweight CMS 外掛已經完成。將該外掛加入專案的 Git submodule：

```shell
$ git submodule add https://example.com/user/myPlugin.git plugins/myPlugin
```

日後可以外掛的更動更新到專案中：

```shell
$ git submodule init
$ git submodule update
```

## 專案貢獻者的用法

身為 PHP 程式設計者，你對開發 Lightweight CMS 本身有興趣。你可以私下保留你的更動 *(註)* 或是將貢獻回傳至本專案。

*(註) 因為 Lightweight CMS 採用 MIT 授權*

建立 Lightweight CMS 的[分支](https://docs.github.com/en/get-started/quickstart/fork-a-repo)。拷貝該分支到本地端：

```shell
$ git clone https://github.com/user/lightweight-cms.git
```

將工作目錄移到該拷貝的根目錄：

```shell
$ cd lightweight-cms
```

用 Composer 安裝所有的相依性：

```shell
$ composer install
```

只要 Lightweight CMS 仍可正常運行，你可以任意地修改此拷貝。你不需要移除 *content* 目錄內的文章。這些文章可以當成檢視修改是否正常運作的範例資料。

你應該對修改過的程式碼進行檢查：

```shell
$ ./tools/bin/lint
```

該腳本會呼叫 PHP Code Sniffer 和 PHPMD。這些工具在檢查時會根據修改過的規則集。我們的撰碼規範尚未完全設置好。

將修改送回分支：

```
$ git push https://github.com/user/lightweight-cms.git
```

傳送 [PR (pull request)](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/about-pull-requests) 給我們。我們會審視你的程式碼。若程式碼符合要求，會將其合併。即使你的 PR 未被接受，我們仍可能會根據你的意圖修改 Lightweight CMS。

如果你很忙碌，可以開啟 [dicussion](https://github.com/cwchentw/lightweight-cms/discussions) 或傳給我們 [issue](https://github.com/cwchentw/lightweight-cms/issues)。

## 網站翻譯者的用法

Lightweight CMS 現在是多語系網站，開放網站文字的翻譯。若你想要將 Lightweight CMS 網站翻到新的語系，請上傳和語系相關的 PR 或是開啟相關 [dicussion](https://github.com/cwchentw/lightweight-cms/discussions)。

在預設情形下，Lightweight CMS 支援 `ltr` (左到右) 文字。對 `rtl` (右到左) 文字仍保持開放。
