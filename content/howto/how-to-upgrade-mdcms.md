---
title: How to Upgrade mdcms
mtime: 2021/7/9
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
* Copy *themes/default* to a new location
* Copy configuration files

Posts in *content* directory are documentation for mdcms. We may alter posts there to reflect changes we make for mdcms. Therefore, you should store your own posts to a location other than *content* directory to prevent unintentional changes on your content. Remember to alter related setting as well.

Similiarly, the theme located in *themes/default* are builtin theme for mdcms. We may change layouts, styles or widgets there. If you desire to modify anything for your need, you should create a copy of *default* theme of mdcms to a new location, adding your modifications there Update related setting to reflect your change.

Occationally, mdcms upstream repo changes its settings. To prevent unwanted modification(s) on personal configurations, copy template configurations into personal ones:

```shell
$ cp config/information.template.php config/information.php
$ cp config/socialMedia.template.php config/socialMedia.php
$ cp config/parameters.template.php config/parameters.php
$ cp config/optionalFeatures.template.php config/optionalFeatures.php
$ cp config/sortCallbacks.template.php config/sortCallbacks.php
$ cp config/internal.template.php config/internal.php
```

On Windows, invoke the following commands instead:

```shell
> copy config\information.template.php config\information.php
> copy config\socialMedia.template.php config\socialMedia.php
> copy config\parameters.template.php config\parameters.php
> copy config\optionalFeatures.template.php config\optionalFeatures.php
> copy config\sortCallbacks.template.php config\sortCallbacks.php
> copy config\internal.template.php config\internal.php
```

## Stick to Specific Version of mdcms

*Not implemented yet*

You may stick to specific version of mdcms to avoid unintentional change. Here we invoke a pseudo command:

```shell
$ git pull https://github.com/cwchentw/mdcms.git 1.0
```

mdcms is still experimental and envolving currently. We may announce some stable version to maintain if we think mdcms is mature enough.
