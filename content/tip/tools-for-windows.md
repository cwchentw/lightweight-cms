---
title: Tips for Tools on Windows
linkTitle: Tools on Windows
mtime: 2023/03/19
weight: 3
---

## Synopsis

This article illustrates the usage of our utility scripts on Windows family systems.

## Migrate a Local Lightweight CMS Repository to a New Site

Invoke the following command:

```shell
$ .\tools\bin\migrate.bat
```

The utility script will create site configuration files and *posts* directory.

## Run Lightweight CMS Sites Locally without IIS, Apache or Nginx

Traditionally, PHP programmers install a web server to run PHP scripts locally. Nonetheless, it is not easy for beginners to write correct configurations for those web servers. With our utility script, you don't need to set up a local web server to run your PHP scripts.

Run this command to run a Lightweight CMS site locally:

```shell
> .\tools\bin\serve.bat
```

By default, this development web server runs on http://localhost:5000. To run a web server on other location, add your location as a parameter:

```shell
> .\tools\bin\serve.bat localhost:3000
```

Internally, this utility script runs a builtin web server of PHP. This feature is available after PHP 5.4 ([ref](https://www.php.net/manual/en/features.commandline.webserver.php)).

## Compile Static Lightweight CMS Sites

Invoke the following command:

```shell
> .\tools\bin\compile.bat
```

## Deploy a Lightweight CMS Site to a PaaS

Run the Unix command to prepare your deployment:

```shell
$ ./tools/bin/publish
```

We implement this script in POSIX shell because most PaaS are based on GNU/Linux. If you choose a Windows PaaS, run this script instead:

```shell
> .\tools\bin\publish.bat
```

These utility scripts will copy router of Lightweight CMS and assets to *public* directory, ready for further step(s) to deploy your site.

See [this article](/howto/how-to-deploy-lightweight-cms-to-digitalocean-app-platform/) for information related to deploy a Lightweight CMS site to a PaaS.

## Synchonize Content to a Production Environment

Let's say you run an local Nginx web server on [Laragon](https://laragon.org/). Run this command to update your change(s) on a production environment:

```shell
> .\tools\bin\sync-to.bat c:\laragon\www\lightweight-cms\
```

Internally, this utility script runs `rsync(1)`. Therefore, don't edit anything on your production environment.

Keep a trailing slash on your target path. It is required for `rsync(1)` to work properly.

## Update Site Settings after Changing Project Structure

Run this command to update site settings each time you change project structure of your Lightweight CMS repo:

```shell
> .\tools\bin\init.bat
```

Site settings of Lightweight CMS is recorded in PHP scripts, which are unusable in other scripting languages. To address this issue, we generate a usable settings for Batch.

## Why are not Some Utility Scripts Available on Windows?

Most PHP developers develop PHP web applications on Unix-equivalent systems. Our utility scripts for Windows intend to run Lightweight CMS sites locally on Windows, not to develop Lightweight CMS itself.
