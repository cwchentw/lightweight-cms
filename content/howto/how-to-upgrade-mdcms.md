---
title: How to Upgrade mdcms
mtime: 2021/6/17
---

## Prologue

As most software, mdcms envolves with time. You may want to upgrade mdcms for new features or bug fixes. This guide demonstrates the process, explaining the rationale as well.

## Synopsis

Here are two-step pseudo commands to upgrade your mdcms repo:

```shell
$ cd path/to/your/mdcms/site
$ git pull https://github.com/cwchentw/mdcms.git
```

Technically, you merge your mdcms snapshot with the master branch of mdcms repo. Git will manage the process without manual intervention unless there are any conflict between the codes of the two repositories.

In the following text, we will indicate what you should be aware to avoid code conflicts.

## No Update at all

The process is optional. You may keep publishing your posts without any update as long as your site runs smoothly.

Some site owners modify their mdcms repos substantially. In such case, such measure may introduce more problems than improvements.

## Things You should not Touch mostly

If you are going to upgrade mdcms, you should not modify these things mostly:

* *www/index.php*
* All things under *src*
* All things at the root path **except** *setting.php*

*www/index.php* works as the router of mdcms, which matches between URLs and the corresponding post files on your web server. Modifying it improperly may cause a defunct mdcms site.

*src* places the core library of mdcms. Unless you want to contribute to mdcms itself, you don't need to change anything here.

Files in the root of mdcms are configurations and documentation. You don't need to alter anything here except *setting.php* for a usable mdcms site.

## Things You should Do for Safe Update

Here we note the actions you should undertake for a safe update:

* Create a directory for your posts other than *content* directory
* Copy *themes/default* to a new location

The posts in *content* directory are the documentation for mdcms. We may alter posts there to reflect the changes we make for mdcms. Therefore, you should store your posts to a location other than *content* directory, setting *setting.php* accordingly to prevent unintentional changes on your content.

Similiarly, the theme located in *themes/default* are the builtin theme for mdcms. We may change layouts, styles or widgets there. If you would modify anything for your need, you should create a copy of default theme of mdcms to a new location, adding your modifications there. Remember to set *setting.php* to reflect your change.

## Stick to Specific Version of mdcms

*Not implemented yet*

You may stick to specific version of mdcms to avoid unintentional change. Here we invoke a pseudo command:

```shell
$ git pull https://github.com/cwchentw/mdcms.git 1.0
```

mdcms is still experimental and envolving currently. We may announce some specific version to maintain if we think mdcms is mature enough.
