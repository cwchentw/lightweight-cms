---
title: 常見問題集
mtime: 2022/09/11
weight: 4
---

摘要
========

This article answers FAQs related to Lightweight CMS.

一般性問題
=================

什麼是 Lightweight CMS？
------------------------------------------

Lightweight CMS is a content management system (CMS), which intends to build content websites.

Lightweight CMS 是免費的嗎？
-------------------------------------------

Definitely, free as in both beer and speech. Lightweight CMS is licensed under `MIT <https://opensource.org/licenses/MIT>`_, feasible even for commercial websites. Currently, we have no paid services for Lightweight CMS.

Lightweight CMS 和 WordPress 有什麼差別？
----------------------------------------------------------------------

Lightweight CMS, as a flat-file CMS, doesn't rely on any relational database to store contents. Instead, posts in Lightweight CMS sites are saved in flat files, either Markdown, AsciiDoc, reStructuredText or HTML.

為什麼開發 Lightweight CMS？
------------------------------------------------

We created Lightweight CMS to migrate some of our website from static sites into dynamic ones while retaining previous Markdown posts. Unlike static sites, dynamic websites can reflect our changes immediately, suitable for frequently modified content websites.

技術性問題
====================

Lightweight CMS 是使用什麼程式語言製作的？
----------------------------------------------------------------------

PHP 8. We select PHP rather than another language because PHP is one of few languages that works as a both template and application language. In addition, PHP hosting services are everywhere.

Currently, many GNU/Linux distributions adapt PHP 8 while some still PHP 7. We have migrated our ``master`` branch to PHP 8.1, leaving our old code to ``php74`` and ``php80`` branches:

====================== ===========
GNU/Linux Distribution PHP Version
====================== ===========
Debian 11              7.4.21
Ubuntu 22.04           8.1.2
Rocky Linux 9.0        8.0.13
Fedora 36              8.1.9
openSUSE Leap 15.4     8.0.10
====================== ===========

如何在舊版 PHP 上執行 Lightweight CMS？
------------------------------------------------------------------

To run Lightweight CMS on PHP 7.4:

.. code-block:: shell

   $ git clone https://github.com/cwchentw/lightweight-cms.git
   $ cd lightweight-cms
   $ git checkout php74

To run Lightweight CMS on PHP 8.0:

.. code-block:: shell

   $ git clone https://github.com/cwchentw/lightweight-cms.git
   $ cd lightweight-cms
   $ git checkout php80

Non-``master`` branches of Lightweight CMS may not contain latest features.

Lightweight CMS 可以在 Windows 上運行嗎？
--------------------------------------------------------------------

Certainly. Many web programmers write code on Windows while deploying applications to GNU/Linux. We adapt this practice as well. Nevertheless, GNU/Linux is recommended as a production environment for mdmcs.

Lightweight CMS 可以在某個 PaaS 上運行嗎？
---------------------------------------------------------------------

Maybe not. Every PaaS owns some catches. We cannot guarantee that Lightweight CMS will run on your PaaS vendor. In contrary, a GNU/Linux VPS with PHP plus either Apache or Nginx is recommended because of simplicity.

特性相關問題
=============================

Lightweight CMS 支援那種輕量級標記語言？
-----------------------------------------------------------

`Markdown <https://github.github.com/gfm/>`_, `AsciiDoc <https://asciidoc.org/>`_ and `reStructuredText <https://docutils.sourceforge.io/rst.html>`_. Different markup languages met different use cases; hence, we support three common lightweight markup languages in our software.

為什麼修改部分 AsciiDoc 模板？
------------------------------------------

Some HTML tags rendered by AsciiDocter by default are counter-intuitive for web developers. To address these issues, we modify the templates of some HTML tags while retaining the semantic structures among the HTML tags set by AsciiDoctor.
