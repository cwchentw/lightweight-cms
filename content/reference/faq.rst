---
title: Frequent Asked Questions
mtime: 2023/03/19
weight: 4
---

Synopsis
========

This article answers FAQs related to Lightweight CMS.

General Questions
=================

What is Lightweight CMS?
-------------------------

Lightweight CMS is a content management system (CMS), which intends to build content websites.

Is Lightweight CMS Free?
-------------------------

Definitely, free as in both beer and speech. Lightweight CMS is licensed under `MIT <https://opensource.org/licenses/MIT>`_, feasible even for commercial websites. Currently, we have no paid services for Lightweight CMS.

What is Differences between Lightweight CMS and WordPress?
-----------------------------------------------------------

Lightweight CMS, as a flat-file CMS, doesn't rely on any relational database to store contents. Instead, posts in Lightweight CMS sites are saved in flat files, either Markdown, AsciiDoc, reStructuredText or HTML.

Why is Lightweight CMS Created?
--------------------------------

We created Lightweight CMS to migrate some of our website from static sites into dynamic ones while retaining previous Markdown posts. Unlike static sites, dynamic websites can reflect our changes immediately, suitable for frequently modified content websites.

Technical Questions
====================

Which Language is Utilized to Implement Lightweight CMS?
---------------------------------------------------------

PHP 8. We select PHP rather than another language because PHP is one of few languages that works as a both template and application language. In addition, PHP hosting services are everywhere.

Currently, many GNU/Linux distributions adapt PHP 8 while some still PHP 7. We have migrated our ``master`` branch to PHP 8.1, leaving our old code to ``php80`` branches:

====================== ===========
GNU/Linux Distribution PHP Version
====================== ===========
Debian 11              7.4.21
Ubuntu 22.04           8.1.2
Rocky Linux 9.0        8.0.13
Fedora 36              8.1.9
openSUSE Leap 15.4     8.0.10
====================== ===========

How to Run Lightweight CMS on old PHP?
--------------------------------------

To run Lightweight CMS on PHP 8.0:

.. code-block:: shell

   $ git clone https://github.com/cwchentw/lightweight-cms.git
   $ cd lightweight-cms
   $ git checkout php80

Non-``master`` branches of Lightweight CMS may not contain latest features.

Does Lightweight CMS Run on Windows?
--------------------------------------

Certainly. Many web programmers write code on Windows while deploying applications to GNU/Linux. We adapt this practice as well. Nevertheless, GNU/Linux is recommended as a production environment for Lightweight CMS.

Does Lightweight CMS Run on XXX PaaS?
--------------------------------------

Maybe not. Every PaaS owns some catches. We cannot guarantee that Lightweight CMS will run on your PaaS vendor. In contrary, a GNU/Linux VPS with PHP plus either Apache or Nginx is recommended because of simplicity.

Feature Questions
===================

What Lightweight Markup Languages are Supported?
-------------------------------------------------

`Markdown <https://github.github.com/gfm/>`_, `AsciiDoc <https://asciidoc.org/>`_ and `reStructuredText <https://docutils.sourceforge.io/rst.html>`_. Different markup languages met different use cases; hence, we support three common lightweight markup languages in our software.

Why Some AsciiDoc Templates are Modified?
------------------------------------------

Some HTML tags rendered by AsciiDocter by default are counter-intuitive for web developers. To address these issues, we modify the templates of some HTML tags while retaining the semantic structures among the HTML tags set by AsciiDoctor.
