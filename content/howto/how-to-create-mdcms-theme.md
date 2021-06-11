# How to Create a mdcms Theme

## Prologue

This guide illustrates to create a mdcms theme, taking [default theme](https://github.com/cwchentw/mdcms/tree/master/themes/default) of mdcms as an instance.

## Project Structure of a mdcms Theme

Pending.

## *autoload.php* of a mdcms Theme

This PHP script is the only mandatory file of a mdcms theme. The script should always locate in the root path of a mdcms theme. You may implement required functions within it or load another PHP script.

## `loadHome()` Function

The essential function to load the layout for the home page of a mdcms site. It receives no parameter. Theme creators are responsible to load a layout for a home page properly.

Here is a sample code:

```php
function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}
```

It is recommended to use `require` instead of `include` here because it should be an error unable to load a layout properly.

## `loadSection()` Function

The necessary function to load the layout for sections of a mdcms site. In a similiar fashion, it receives no parameter. Here shows an example:

```php
function loadSection()
{
    require __DIR__ . "/theme/" . "section.php";
}
```
