# How to Upgrade mdcms

## Prologue

As most software, mdcms envolves with time. You may want to upgrade mdcms to receive new features or bug fixes. This guide demonstrates the process, explaining the rationale as well.

## Synopsis

Here are pseudo commands to upgrade mdcms:

```shell
$ cd path/to/your/mdcms/site
$ git pull https://github.com/cwchentw/mdcms.git
```

Technically, you merge your mdcms snapshot with the master branch of mdcms repo. We will indicate what you should be aware in the following text.

## No Upgrade at all

## Things You should not Touch mostly

* *www/index.php*
* All things under *src*
* All things at the root path **except** *setting.php*

## Things You should Modify before Update

* Create a directory other than *content*
* Copy *themes/default* to a new location
