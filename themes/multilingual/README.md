# Multilingual Theme for Lightweight CMS

## Synopsis

This is *multilingual* theme for Lightweight CMS. In addition, it serves as a template to create other themes.

## Note

This theme intends for multilingual sites, code of which is inevitably more complex than that of the themes for monolingual sites. If no multilingual site is required, check our [default theme](/themes/default/) instead.

Each time you modify your site information, invoke the following command to update the default translation JSON file:

```shell
$ ./themes/multilingual/tools/bin/trans
```

On Windows, run the command instead:

```shell
> .\themes\multilingual\tools\bin\trans.bat
```

You still need to modify the translation JSON files other than the default one.

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
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "layout" . $sep . "home.php";
}
```

### `loadSection()` Function

In a similar fashion, the function doesn't accept any parameter. Here shows a sample code:

```php
function loadSection()
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    if ("/zh-tw/" === $_SERVER["REQUEST_URI"]) {
        require $rootDirectory . $sep . "layout" . $sep . "home.php";
    }
    else if ("/en-us/" === $_SERVER["REQUEST_URI"]) {
        require $rootDirectory . $sep . "layout" . $sep . "home.php";
    }
    else {
        require $rootDirectory . $sep . "layout" . $sep . "section.php";
    }
}
```

### `loadPost()` Function

Here is an example:

```php
function loadPost()
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "layout" . $sep . "post.php";
}
```

### `loadPage()` Function

Here is an example:

```php
function loadPage ()
{
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "layout" . $sep . "page.php";
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
        \LightweightCMS\Core\xCopy($publicDirectory, $dest);
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

## Add More Locales

There are three conventional policies for multilingual sites:

* Multiple domains
* Same domain, multiple subdomains
* Same domain, same subdomain

Among them, the latest is best for SEO because all web pages contribute to a single domain. This theme confirms the same policy as well.

This theme adapts the URI prefix of a web page as its locale. You may add more locale(s) as needed. Follow our code conventions while adding another locale for your website.

## Copyright

Copyright (c) ByteBard. Licensed under MIT
