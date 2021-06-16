# How to Update mdcms

## Prologue

## Synopsis

```shell
$ cd path/to/your/mdcms/site
$ git pull https://github.com/cwchentw/mdcms.git
```

## No Update at all

## Things You should not Touch mostly

* *www/index.php*
* All things under *src*
* All things at the root path **except** *setting.php*

## Things You should Modify before Update

* Create a directory other than *content*
* Copy *themes/default* to a new location
