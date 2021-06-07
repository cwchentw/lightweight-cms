# The Default Theme for mdcms

## Synopsis

This is the default theme for mdcms. In addition, it serves as a template to create other themes.

## For End Users

This theme represents a generic one, best suitable for documentation sites. You can safely keep the theme *as is*. If you want to alter anything here, create a new theme by either copying this directory to a new location or implementing everything from scratch.

## For Theme Creators

The project structure of a mdcms theme is very liberal. The only mandatory file is *autoload.php* in the root of a theme directory.

There are only four mandatory functions in such *autoload.php*:

* `loadHome()`: Load the layout of the home page
* `loadSection()`: Load the layout of sections
* `loadPost()`: Load the layout of posts
* `loadAssets($dest)`: Load assets

### `loadHome()` Function

Here shows a sample code:

```php
function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}
```

mdcms doesn't know your project structure. You are responsible to load a layout correctly.

### `loadSection()` Function

Here shows a sample code:

```php
function loadSection()
{
    require __DIR__ . "/theme/" . "section.php";
}
```

### `loadPost()` Function

Here is an example:

```php
function loadPost()
{
    require __DIR__ . "/theme/" . "post.php";
}
```
