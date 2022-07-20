# Default Theme for Lightweight CMS

## Synopsis

This is *default* theme for Lightweight CMS. In addition, it serves as a template to create other themes.

## Warning

As Lightweight CMS itself, this theme is experimental as well. If you want to create a new theme for Lightweight CMS, refer here to see whether any modification occurs.

## System Requirements

* Production environment
  * A [modern browser](https://browsehappy.com/) like Chrome and Firefox
  * [Normalize.css](https://necolas.github.io/normalize.css/)
  * [Bootstrap 5](https://getbootstrap.com/)
  * [Bootstrap.Native](https://thednp.github.io/bootstrap.native/)
  * (Optional) [highlight.js](https://highlightjs.org/)
* Development environment
  * Node.js
  * [Gulp](https://gulpjs.com/)
  * [Sass](https://sass-lang.com/)
  * [Autoprefixer](https://github.com/postcss/autoprefixer)
  * [stylelint](https://stylelint.io/)
  * [Babel](https://babeljs.io/)
  * [Flow](https://flow.org/en/)

## For End Users

This theme represents a generic one, best suitable for documentation sites. You can safely keep this theme *as is*. If you want to alter anything here, create a new theme by copying this directory to a new location or there may be code conflicts when you update Lightweight CMS with Git.

## For Theme Creators

The project structure of a Lightweight CMS theme is very liberal. The only mandatory file is *autoload.php* in the root path of a Lightweight CMS theme directory.

There are only five mandatory functions in a Lightweight CMS theme currently:

* `loadHome()`: Load a layout of home page
* `loadSection()`: Load a layout of sections
* `loadPost()`: Load a layout of posts
* `loadPage()`: Load a layout of pages
* `loadAssets($dest)`: Load assets

### `loadHome()` Function

The function doesn't accept any parameter. Theme creators are responsible to load a layout of home page of a site properly. Here shows a sample code:

```php
function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}
```

### `loadSection()` Function

In a similar fashion, the function doesn't accept any parameter. Here shows a sample code:

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

### `loadPage()` Function

*Not implemented yet*

Here is an example:

```php
function loadPage()
{
    require __DIR__ . "/theme/" . "page.php";
}
```

### `loadAssets($dest)` Function

This function accepts one parameter, which represents a destination path to copy assets.

This theme adapts Sass and Babel as the front end stacks. Such assets need compilation before deploying to a production environment. In this sample code, we call NPM to compile assets and copy their outputs recursively to a destination directory set by Lightweight CMS:

```php
function loadAssets($dest)
{
    # Save the path of old working directory.
    $oldDirectory = getcwd();

    global $rootDirectory;

    # Move to theme directory.
    if (!chdir($rootDirectory)) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw new \Exception("Unable to change working directory to theme directory");
    }

    # We don't update NPM packages because they are merely for build automation.
    if (!(file_exists("node_modules") && is_dir("node_modules"))) {
        if (!system("npm install")) {
            # Move back to old working directory.
            chdir($oldDirectory);

            throw new \Exception("Unable to install NPM packages");
        }
    }

    # Compile assets.
    #
    # Not every theme invoke the same command to compile assets.
    #  Modify it according to your own situation.
    if (!system("npm run prod")) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw new \Exception("Unable to compile assets");
    }

    # Copy assets recursively.
    try {
        $publicDirectory = $rootDirectory . "/public";

        # xCopy is a utility function in Lightweight CMS.
        #  It will copy directories and files recursively.
        \mdcms\Core\xCopy($publicDirectory, $dest);
    }
    catch (Exception $e) {
        # Move back to old working directory.
        chdir($oldDirectory);

        throw $e;
    }

    # Move back to old working directory.
    chdir($oldDirectory);
}
```
If you write vanilla CSS and JavaScript code, you don't require to call NPM in advance. Simply copy assets to a destination.

In contrary, if you utilize another front end stack(s) like Less and TypeScript, you have to implement your own build automation scripts as well.

## Copyright

Copyright (c) Michelle Chen. Licensed under MIT
