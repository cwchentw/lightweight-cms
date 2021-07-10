---
title: How to Upgrade mdcms
mtime: 2021/7/10
---

## Prologue

As most software, mdcms envolves with time. You may want to upgrade mdcms for new features or bug fixes. This guide demonstrates the process, explaining the rationale as well.

## Synopsis

Here are two-step pseudo commands to upgrade your mdcms repo:

```shell
$ cd path/to/your/mdcms/site
$ git pull https://github.com/cwchentw/mdcms.git
```

Technically, you merge your mdcms snapshot with master branch of mdcms repo. Git will manage the process without manual intervention unless there are any conflict between codes of the two repositories.

In the following text, we will indicate what you should be aware to avoid code conflicts.

## No Update at all

The process is optional. You may keep writing and publishing your posts without any update as long as your site runs smoothly.

Some site owners modify their mdcms repo(s) substantially. In such case, update may introduce more problems than improvements.

## Things You should not Touch mostly

If you are going to upgrade mdcms, you should not modify these things mostly:

* *www/index.php*
* All things under *src*
* All things at root path

*www/index.php* works as router of mdcms, which matches between a URL and corresponding post file on your web server. Modifying it improperly may result in a defunct mdcms site.

*src* places core library of mdcms. Unless you want to contribute to mdcms itself, you don't need to change anything here.

Files located in root path of mdcms are configurations and documents. You don't need to alter anything here for a usable mdcms site.

## Things You should Do for Safe Update

Here we note the actions you should undertake for a safe update:

* Create a directory for your posts other than *content* directory
* Copy configuration files
* Copy *themes/default* to a new location

Invoke this command to migrate local mdcms repository to a new site:

```shell
$ ./tools/bin/migrate
```

On Windows, invoke this command instead:

```shell
$ .\tools\bin\migrate.bat
```

These utility scripts will create site configuration files and *posts* directory.

The theme located in *themes/default* is builtin theme for mdcms. We may change layouts, styles or widgets there. If you desire to modify anything for your need, you should create a copy of *default* theme of mdcms to a new location, adding your modifications there Update related setting to reflect your change.

## Stick to Specific Version of mdcms

*Not implemented yet*

You may stick to specific version of mdcms to avoid unintentional change. Here we invoke a pseudo command:

```shell
$ git pull https://github.com/cwchentw/mdcms.git 1.0
```

mdcms is still experimental and envolving currently. We may announce some stable version to maintain if we think mdcms is mature enough.
