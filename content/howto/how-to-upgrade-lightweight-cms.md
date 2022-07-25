---
title: How to Upgrade Lightweight CMS
linkTitle: Upgrade Lightweight CMS
mtime: 2021/7/10
---

## Prologue

As most software, Lightweight CMS envolves with time. You may want to upgrade Lightweight CMS for new features or bug fixes. This guide demonstrates the process, explaining the rationale as well.

## Synopsis

Here are two-step pseudo commands to upgrade your Lightweight CMS repo:

```shell
$ cd path/to/your/lightweight-cms/site
$ git pull https://github.com/cwchentw/lightweight-cms.git
```

Technically, you merge your Lightweight CMS snapshot with master branch of Lightweight CMS repo. Git will manage the process without manual intervention unless there are any conflict between codes of the two repositories.

In the following text, we will indicate what you should be aware to avoid code conflicts.

## No Update at all

The process is optional. You may keep writing and publishing your posts without any update as long as your site runs smoothly.

Some site owners modify their Lightweight CMS repo(s) substantially. In such case, update may introduce more problems than improvements.

## Things You should not Touch mostly

If you are going to upgrade Lightweight CMS, you should not modify these things mostly:

* *www/index.php*
* All things under *src*
* All things at root path

*www/index.php* works as the router of Lightweight CMS, which matches between a URL and corresponding post file on your web server. Modifying it improperly may result in a defunct Lightweight CMS site.

*src* places core library of Lightweight CMS. Unless you want to contribute to Lightweight CMS itself, you don't need to change anything here.

Files located in root path of Lightweight CMS are configurations and documents. You don't need to alter anything here for a usable Lightweight CMS site.

## Things You should Do for Safe Update

Here we note the actions you should undertake for a safe update:

* Create a directory for your posts other than *content* directory
* Copy configuration files
* Copy *themes/default* to a new location

Invoke this command to migrate local Lightweight CMS repository to a new site:

```shell
$ ./tools/bin/migrate
```

On Windows, invoke this command instead:

```shell
$ .\tools\bin\migrate.bat
```

These utility scripts will create site configuration files and *posts* directory.

The theme located in *themes/default* is the builtin theme for Lightweight CMS. We may change layouts, styles or widgets there. If you desire to modify anything for your need, you should create a copy of *default* theme of Lightweight CMS to a new location, adding your modifications there. Update related setting to reflect your change.

## Stick to Specific Version of Lightweight CMS

*Not implemented yet*

You may stick to specific version of Lightweight CMS to avoid unintentional change. Here we invoke a pseudo command:

```shell
$ git pull https://github.com/cwchentw/lightweight-cms.git 1.0
```
