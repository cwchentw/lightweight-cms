---
title: Frequent Asked Questions
mtime: 2022/4/25
weight: 4
---

Synopsis
--------

This article answers FAQs related to mdcms.

What is mdcms?
--------------

mdcms is a content management system (CMS), which intends to build content websites.

Is mdcms Free?
--------------

Definitely, free as in both beer and speech. mdcms is licensed under MIT, feasible even for commercial websites. Currently, we have no paid services for mdcms.

What is Differences between mdcms and WordPress?
-------------------------------------------------

mdcms, as a flat-file CMS, doesn't rely on any relational database to store contents. Instead, posts in mdcms sites are saved in flat files, either Markdown, AsciiDoc, reStructuredText or HTML.

Why is mdcms Created?
----------------------

We created mdcms to migrate some of our website from static sites into dynamic ones while retaining previous Markdown posts. Unlike static sites, dynamic websites can reflect our changes immediately, suitable for frequently modified content websites.

Which Language is Utilized to Implement mdcms?
-----------------------------------------------

PHP 8. We select PHP rather than another language because PHP is one of few languages that works as a both template and application language. In addition, PHP hosting services are everywhere.

Currently, some GNU/Linux distributions adapt PHP 8 while some still PHP 7. We have migrated our `master` branch to PHP 8, leaving our old code to `php74` branch:

====================== ===========
GNU/Linux Distribution PHP Version
====================== ===========
Debian 11              7.4.21
Ubuntu 22.04           8.1.2
Rocky Linux 8.5        7.2.24 (*)
Fedora 35              8.0.14 (*)
openSUSE Leap 15.3     7.4.6
====================== ===========

*(\*) Rocky Linux 8.5 and Fedora 35 are not usable for mdcms.*

Does mdcms Run on Windows?
---------------------------

Certainly. Many web programmers write code on Windows while deploying applications to GNU/Linux. We adapt this practice as well. Nevertheless, GNU/Linux is recommended as a production environment for mdmcs.

Does mdcms Run on XXX PaaS?
----------------------------

Maybe not. Every PaaS owns some catches. We cannot guarantee that mdcms will run on your PaaS vendor. In contrary, a GNU/Linux VPS with PHP plus either Apache or Nginx is recommended because of simplicity.

What Lightweight Markup Languages are Supported?
-------------------------------------------------

`Markdown <https://github.github.com/gfm/>`_, `AsciiDoc <https://asciidoc.org/>`_ and `reStructuredText <https://docutils.sourceforge.io/rst.html>`_. Different markup languages met different use cases; hence, we support three common lightweight markup languages in our software.
