# How to Upgrade mdcms

## Prologue

As most software, mdcms envolves with time. You may want to upgrade mdcms for new features or bug fixes. This guide demonstrates the process, explaining the rationale as well.

## Synopsis

Here are two-step pseudo commands to upgrade your mdcms repo:

```shell
$ cd path/to/your/mdcms/site
$ git pull https://github.com/cwchentw/mdcms.git
```

Technically, you merge your mdcms snapshot with the master branch of mdcms repo. In the following text, we will indicate what you should be aware.

## No Upgrade at all

The upgradation is not mandatory. You may keep publishing your posts without any upgradation as long as your site runs smoothly.

## Things You should not Touch mostly

* *www/index.php*
* All things under *src*
* All things at the root path **except** *setting.php*

## Things You should Modify before Update

* Create a directory other than *content*
* Copy *themes/default* to a new location
