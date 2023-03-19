---
title: 在 Unix 使用工具的訣竅
linkTitle: 在 Unix 使用工具
mtime: 2023/03/19
weight: 2
---

## 前言

This article illustrates the usage of our utility scripts on Unix-equivalent systems.

## 選移本地端 Lightweight CMS 網站

Invoke the following command:

```shell
$ ./tools/bin/migrate
```

The utility script will create site configuration files and *posts* directory.

## 不使用 Apache 或 Nginx 運行本地端 Lightweight CMS 網站

Traditionally, PHP programmers install either Apache or Nginx to run PHP scripts locally. Nonetheless, it is not easy for beginners to write correct configurations for those web servers. With our utility script, you don't need to set up a local web server to run PHP scripts.

Invoke this command to run a Lightweight CMS site locally:

```shell
$ ./tools/bin/serve
```

By default, this development web server runs on http://localhost:5000. To run a web server on other location, add your location as a parameter:

```shell
$ ./tools/bin/serve localhost:3000
```

If you need promoted priviledge, run it with `sudo(1)`:

```shell
$ sudo ./tools/bin/serve
```

Internally, this utility script runs a builtin web server of PHP. This feature is available after PHP 5.4 ([ref](https://www.php.net/manual/en/features.commandline.webserver.php)).

## 編譯靜態 Lightweight CMS 網站

Invoke the following command:

```shell
$ ./tools/bin/compile
```

## 發佈 Lightweight CMS 到 PaaS

Run the command to prepare your deployment:

```shell
$ ./tools/bin/publish
```

We implement this script in POSIX shell because most PaaS are based on GNU/Linux. If you choose a Windows PaaS, run this script instead:

```shell
$ .\tools\bin\publish.bat
```

These utility scripts will copy router of Lightweight CMS and assets to *public* directory, ready for further step(s) to deploy your site.

See [this article](/howto/how-to-deploy-lightweight-cms-to-digitalocean-app-platform/) for information related to deploy a Lightweight CMS site to a PaaS.

## 在生產環境同步內容

Invoke this command to update your change(s) on a production environment:

```shell
$ ./tools/bin/sync-to path/to/www
```

If you need promoted priviledge, run it with `sudo(1)`:

```shell
$ sudo ./tools/bin/sync-to /path/to/www
```

Internally, this utility script runs `rsync(1)`. Therefore, don't edit anything on your production environment.

## 在專案結構更動後更新網站設置

Invoke this command to update site settings each time you change project structure of your Lightweight CMS repo:

```shell
$ ./tools/bin/init
```

Site settings of Lightweight CMS is recorded in PHP scripts, which are unusable in other scripting languages. To address this issue, we generate a usable settings for POSIX shell.
