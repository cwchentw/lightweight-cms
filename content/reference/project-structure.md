---
title: The Project Structure of Lightweight CMS
linkTitle: Project Structure
mtime: 2023/03/19
weight: 5
---

## Prologue

This article illustrates project structure of Lightweight CMS to give its users a roadmap to Lightweight CMS.

## Bird View of Lightweight CMS

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

## *content* Directory

*content* directory stores site posts. In Lightweight CMS repository, this directory hoards live documentation of Lightweight CMS.

If you don't need to update your Lightweight CMS snapshot, you may safely delete all sample posts in *content* directory, adding your own. In contrary, if you are going to update your Lightweight CMS repo, see [this article](/howto/upgrade-lightweight-cms/) for more information.

## *setting.php* and *config* Directory

*config* directory stores site settings. We split Lightweight CMS settings into multiple PHP scripts for easier management. *setting.php* works as a loader to those settings.

## *themes* Directory

*themes* directory saves theme(s) for Lightweight CMS. There is at least one *default* theme for Lightweight CMS users. If you want to create or modify your own theme, see [this article](/howto/create-lightweight-cms-theme/).

## *plugins* Directory

*plugins* directory saves plugin(s) for Lightweight CMS. Currently, there is merely few plugins inside. We and community contributors will add more in the future.

## *static* Directory

*static* directory keeps static files. They will be sent to client environments without any modification.

## *assets* Directory

*assets* directory stows assets for front end. Unlike things in *static* directory, stuffs in *assets* require processing or compiling before senting to client environments.

See [this article](/howto/manage-assets/) for information related to asset management in Lightweight CMS.

## *build* Directory

*build* directory places Gulp build scripts for builtin front end stacks used by Lightweight CMS. You may need to modify lists of directories and files to delete. We may change this situation later.

## *www* Directory

*www* directory places back end PHP scripts of Lightweight CMS on production environments. Currently, there is only a script in this directory - *index.php*, which is the router of Lightweight CMS.

Users of Lightweight CMS don't require to alter anything there mostly unless you want to contribute to Lightweight CMS itself.

## *src* Directory

*src* directory hoards internal library of Lightweight CMS. Users of Lightweight CMS don't need to change anything there unless you want to contribute to Lightweight CMS itself.

## *tools* Directory

*tools* directory stores utility scripts for Lightweight CMS. We implement utility scripts in POSIX shell on Unix and those in Batch on Windows. You don't need to alter anything there.

## Stuffs in Root Path of Lightweight CMS

They are documentation for Lightweight CMS and configurations for build scripts for assets. You don't need to alter anything there.
