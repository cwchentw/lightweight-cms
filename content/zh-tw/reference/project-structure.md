---
title: 專案架構
linkTitle: 專案架構
mtime: 2022/09/11
weight: 5
---

## 前言

This article illustrates project structure of Lightweight CMS to give its users a roadmap to Lightweight CMS.

## 俯視 Lightweight CMS

Here we browse project structure of Lightweight CMS with `tree(1)`:

```shell
$ tree -a -L 1 -F
.
├── assets/
├── .browserlistrc
├── build/
├── composer.json
├── composer.lock
├── config/
├── content/
├── .eslintrc
├── .flowconfig
├── .git/
├── .gitignore
├── LICENSE
├── node_modules/
├── package.json
├── package-lock.json
├── plugins/
├── public/
├── README.md
├── setting.php
├── src/
├── static/
├── .stylelintrc
├── themes/
├── TODO.md
├── tools/
├── vendor/
└── www/
```

We will introduce them in the following text.

## *content* 目錄

*content* directory stores site posts. In Lightweight CMS repository, this directory hoards live documentation of Lightweight CMS.

If you don't need to update your Lightweight CMS snapshot, you may safely delete all sample posts in *content* directory, adding your own. In contrary, if you are going to update your Lightweight CMS repo, see [this article](/howto/how-to-upgrade-lightweight-cms/) for more information.

## *setting.php* 和 *config* 目錄

*config* directory stores site settings. We split Lightweight CMS settings into multiple PHP scripts for easier management. *setting.php* works as a loader to those settings.

## *themes* 目錄

*themes* directory saves theme(s) for Lightweight CMS. There is at least one *default* theme for Lightweight CMS users. If you want to create or modify your own theme, see [this article](/howto/how-to-create-lightweight-cms-theme/).

## *plugins* 目錄

*plugins* directory saves plugin(s) for Lightweight CMS. Currently, there is no plugin inside. We and community contributors will add more in the future.

## *static* 目錄

*static* directory keeps static files. They will be sent to client environments without any modification.

## *assets* 目錄

*assets* directory stows assets for front end. Unlike things in *static* directory, stuffs in *assets* require processing or compiling before senting to client environments.

See [this article](/howto/how-to-manage-assets/) for information related to asset management in Lightweight CMS.

## *build* 目錄

*Experimental*

*build* directory places Gulp build scripts for builtin front end stacks used by Lightweight CMS. You may need to modify lists of directories and files to delete. We may change this situation later.

## *www* 目錄

*www* directory places back end PHP scripts of Lightweight CMS on production environments. Currently, there is only a script in this directory - *index.php*, which is the router of Lightweight CMS.

Users of mdmcs don't require to alter anything there mostly unless you want to contribute to Lightweight CMS itself.

## *src* 目錄

*src* directory hoards internal library of Lightweight CMS. Users of Lightweight CMS don't need to change anything there unless you want to contribute to Lightweight CMS itself.

## *tools* 目錄

*tools* directory stores utility scripts for Lightweight CMS. We implement utility scripts in POSIX shell on Unix and those in Batch on Windows. You don't need to alter anything there.

## 放在根目錄的東西

They are documentation for Lightweight CMS and configurations for build scripts for assets. You don't need to alter anything there.
