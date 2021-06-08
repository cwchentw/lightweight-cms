# The Default Theme for mdcms

## Synopsis

This is the default theme for mdcms. In addition, it serves as a template to create other themes.

## Warning

As mdcms itself, this theme is experimental as well. If you want to create a new theme for mdcms, refer here to see whether any modification occurs.

## For End Users

This theme represents a generic one, best suitable for documentation sites. You can safely keep the theme *as is*. If you want to alter anything here, create a new theme by copying this directory to a new location or there may be conflicts when you update mdcms with Git.

## For Theme Creators

The project structure of a mdcms theme is very liberal. The only mandatory file is *autoload.php* in the root of a theme directory.

There are only four mandatory functions in such *autoload.php*:

* `loadHome()`: Load the layout of the home page of a site
* `loadSection()`: Load the layout of sections
* `loadPost()`: Load the layout of posts
* `loadAssets($dest)`: Load assets

### `loadHome()` Function

The function doesn't accept any parameter. Theme creators are responsible to load the layout of the home page of a site properly. Here shows a sample code:

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

### `loadAssets($dest)` Function

This theme adapts Sass and Babel as the front end stacks. Assets need compilation before deploying to a production environment. In this sample code, we call NPM to compile assets and copy their outputs recursively to a destination set by mdcms:

```php
function loadAssets($dest)
{
    # Save the path of old working directory.
    $oldDirectory = getcwd();

    # Move to theme directory.
    if (!chdir(__DIR__)) {
        # Move back to old working directory.
        chdir($oldDirectory);
        throw new Exception("Unable to change working directory to theme directory");
    }

    # We don't update NPM packages because they are merely for build automation.
    if (!(file_exists("node_modules") && is_dir("node_modules"))) {
        if (!system("npm install")) {
            # Move back to old working directory.
            chdir($oldDirectory);
            throw new Exception("Unable to install NPM packages");
        }
    }

    # Compile assets.
    if (!system("npm run prod")) {
        # Move back to old working directory.
        chdir($oldDirectory);
        throw new Exception("Unable to compile assets");
    }

    # Copy assets recursively.
    try {
        $publicDirectory = __DIR__ . "/public";
        # xCopy is a utility function in mdcms.
        #  It will copy directories and files recursively.
        xCopy($publicDirectory, $dest);
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

In contrary, if you utilize another CSS and/or JavaScript stack(s) like Less and TypeScript, you have to implement your own build automation scripts as well.
