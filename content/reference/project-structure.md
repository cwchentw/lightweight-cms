---
title: Project Structure of mdcms
mtime: 2021/6/26
weight: 2
---

## Prologue

This article illustrates project structure of mdcms to give its users a roadmap to mdcms.

## Bird View of mdcms

Here we browse project structure of mdcms with `tree(1)`:

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

*content* directory stores site posts. In mdcms repository, this directory hoards live documentation of mdcms.

If you don't need to update your mdcms snapshot, you may safely delete all sample posts in *content* directory, adding your own. In contrary, if you are going to update your mdcms repo, see [this article](/howto/how-to-upgrade-mdcms/) for more information.

## *setting.php* and *config* Directory

*config* directory stores site settings. We split mdcms settings into multiple PHP scripts for easier management. *setting.php* works as a loader to those settings.

## *themes* Directory

*themes* directory saves theme(s) for mdcms. There is at least one *default* theme for mdcms users. If you want to create or modify your own theme, see [this article](/howto/how-to-create-mdcms-theme/).

## *plugins* Directory

*plugins* directory saves plugin(s) for mdcms. Currently, there is no plugin inside. We and community contributors will add more in the future.

## *static* Directory

*static* directory keeps static files. They will be sent to client environments without any modification.

## *assets* Directory

*assets* directory stows assets for front end. Unlike things in *static* directory, stuffs in *assets* require processing or compiling before senting to client environments.

See [this article](/howto/how-to-manage-assets/) for information related to asset management in mdcms.

## *build* Directory

*Experimental*

*build* directory places Gulp build scripts for builtin front end stacks used by mdcms. You may need to modify lists of directories and files to delete. We may change this situation later.

## *www* Directory

*www* directory places back end PHP scripts of mdcms on production environments. Currently, there is only a script in this directory - *index.php*, which is the router of mdcms.

Users of mdmcs don't require to alter anything there mostly unless you want to contribute to mdcms itself.

## *src* Directory

*src* directory hoards internal library of mdcms. Users of mdcms don't need to change anything there unless you want to contribute to mdcms itself.

## *tools* Directory

*tools* directory stores utility scripts for mdcms. We implement utility scripts in POSIX shell on Unix and those in Batch on Windows. You don't need to alter anything there.

## Stuffs in Root Path of mdcms

They are documentation for mdcms and configurations for build scripts for assets. You don't need to alter anything there.
