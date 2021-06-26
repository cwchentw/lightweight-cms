---
title: Project Structure of mdcms
mtime: 2021/6/26
weight: 2
---

## Prologue

Pending.

## A Bird View of mdcms

Pending.

## *content* Directory

*content* directory stores site posts. In mdcms repository, this directory hoards live documentation of mdcms.

If you don't need to update your mdcms snapshot, you may safely delete all sample posts in *content* directory, adding your own. In contrary, if you are going to update your mdcms repo, see [this article](/howto/how-to-upgrade-mdcms/) for more information.

## *setting.php* and *config* Directory

*config* directory stores site settings. We split mdcms settings into multiple PHP scripts for easier management. *setting.php* works as a loader to site settings.

## *static* Directory

*static* directory keeps static files. They will be sent to client environments without any modification.

## *assets* Directory

*assets* directory stows assets for front end. Unlike things in *static* directory, stuffs in *assets* require processing or compiling before senting to client environments.

See [this article](/howto/how-to-manage-assets/) for more information related to asset management in mdcms.
