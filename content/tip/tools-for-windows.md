---
title: Tips to Tools for Windows
mtime: 2021/6/30
---

## Synopsis

This article illustrates the usage of our utility scripts on Windows family systems.

## How to Run mdcms Sites Locally without IIS, Apache or Nginx

Traditionally, PHP programmers install a web server to run PHP scripts locally. Nonetheless, it is not easy for beginners to write correct configurations for those web servers. With our utility script, you don't need to set up a local web server to run your PHP scripts.

Run this command to run a mdcms site locally:

```shell
> .\tools\bin\serve.bat
```

By default, this development web server runs on http://localhost:5000. To run a web server on other location, add your location as a parameter:

```shell
> .\tools\bin\serve.bat localhost:3000
```

Internally, this utility script runs a builtin web server of PHP. This feature is available after PHP 5.4 ([ref](https://www.php.net/manual/en/features.commandline.webserver.php)).

## How to Synchonize Content to a Production Environment

Let's say you run an local Nginx web server on [Laragon](https://laragon.org/). Run this command to update your change(s) on a production environment:

```shell
> .\tools\bin\sync-to.bat c:\laragon\www\mdcms\
```

Internally, this utility script runs `rsync(1)`. Therefore, don't edit anything on your production environment.

Keep a trailing slash on your target path. It is required for `rsync(1)` to work properly.

## How to Update Site Settings after Changing Project Structure

Run this command to update site settings each time you change project structure of your mdcms repo:

```shell
> .\tools\bin\init.bat
```

Site settings of mdmcs is recorded in PHP scripts, which are unusable in other scripting languages. To address this issue, we generate a usable settings for Batch.

## Why are not Some Tools Available on Windows

Most PHP developers develop PHP web applications on Unix-equivalent systems. Our utility scripts for Windows intend to run mdcms sites locally on Windows, not to develop mdcms itself.
