---
title: Tips for Tools on Windows
mtime: 2021/7/10
---

## Synopsis

This article illustrates the usage of our utility scripts on Windows family systems.

## Migrate a Local mdcms Repository to a New Site

Invoke the following command:

```shell
$ .\tools\bin\migrate.bat
```

The utility script will create site configuration files and *posts* directory.

## Run mdcms Sites Locally without IIS, Apache or Nginx

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

## Synchonize Content to a Production Environment

Let's say you run an local Nginx web server on [Laragon](https://laragon.org/). Run this command to update your change(s) on a production environment:

```shell
> .\tools\bin\sync-to.bat c:\laragon\www\mdcms\
```

Internally, this utility script runs `rsync(1)`. Therefore, don't edit anything on your production environment.

Keep a trailing slash on your target path. It is required for `rsync(1)` to work properly.

## Deploy a mdcms Site to a PaaS

Run the Unix command to prepare your deployment:

```shell
$ ./tools/bin/publish
```

We implement this script in POSIX shell because most PaaS are based on GNU/Linux. If you choose a Windows PaaS, run this script instead:

```shell
$ .\tools\bin\publish.bat
```

These utility scripts will copy router of mdcms and assets to *public* directory, ready for further step(s) to deploy your site.

See [this article](/howto/how-to-deploy-mdcms-to-digitalocean-app-platform/) for information related to deploy a mdcms site to a PaaS.

## Update Site Settings after Changing Project Structure

Run this command to update site settings each time you change project structure of your mdcms repo:

```shell
> .\tools\bin\init.bat
```

Site settings of mdmcs is recorded in PHP scripts, which are unusable in other scripting languages. To address this issue, we generate a usable settings for Batch.

## Why are not Some Utility Scripts Available on Windows?

Most PHP developers develop PHP web applications on Unix-equivalent systems. Our utility scripts for Windows intend to run mdcms sites locally on Windows, not to develop mdcms itself.
