# How to Create a mdcms Theme

## Prologue

This guide illustrates to create a mdcms theme, taking [default theme](https://github.com/cwchentw/mdcms/tree/master/themes/default) of mdcms as an instance.

## Project Structure

Pending.

## *autoload.php*

This PHP script is the only mandatory file of a mdcms theme. The script should always locate in the root path of a mdcms theme. You may implement required functions within it or load another PHP script.

## Required Functions

### `loadHome()` Function

The essential function to load the layout for the home page in a mdcms site. It receives no parameter. Theme creators are responsible to load a layout for a home page properly.

Here is a sample code:

```php
function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}
```

It is recommended to use `require` instead of `include` here because it should be an error unable to load a layout properly.

### `loadSection()` Function

The necessary function to load the layout for sections in a mdcms site. In a similiar fashion, it receives no parameter. Here shows an example:

```php
function loadSection()
{
    require __DIR__ . "/theme/" . "section.php";
}
```

mdcms doesn't distinguish between top sections and nested ones. Therefore, only one function is needed here.

### `loadPost()` Function

The mandatory function to load the layout for posts in a mdcms site. No parameter is needed. Here shows a sample code:

```php
function loadPost()
{
    require __DIR__ . "/theme/" . "post.php";
}
```

### `loadAssets($dest)` Function

The function to copy assets in a theme to a destination path specified by mdcms. Unlike other functions here, it receives one parameter, which represents a destination path.

[Default theme](https://github.com/cwchentw/mdcms/tree/master/themes/default) of mdcms utilize Sass and Babel as its front end stacks. Code written in the two languages requires compilation before deploying to a production environment.

Here is the function used by default theme of mdcms:

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

        # xCopy is a utility function in mdcms.
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

You should not copy and paste the code here to your own theme. Instead, modify it according to your situation.

## Required Layouts

### Layout for the Home Page

Here is [a sample layout](https://github.com/cwchentw/mdcms/blob/master/themes/default/theme/home.php) of the home page in a mdcms theme.

There are three global variables in this layout:

* `$GLOBALS[MDCMS_SECTIONS]`: An array of top sections of a mdcms site
* `$GLOBALS[MDCMS_POSTS]`: An array of posts without any section of a mdcms site
* `$GLOBALS[MDCMS_CONTENT]` (not implemented yet): A text of optional content of the home page of a mdcms site

### Layout for Sections

[the layout](https://github.com/cwchentw/mdcms/blob/master/themes/default/theme/section.php)

### Layout for Posts

[the layout](https://github.com/cwchentw/mdcms/blob/master/themes/default/theme/post.php)

## Best Practices

### Avoid Namespace

The rounter of mdcms views these required functions as global ones. Therefore, don't add any namespace in these functions.

### Load Third-Party Libraries

You may need features other than those in the core library of mdcms. If you need any third-party library, you should load them in the main loader, i.e. *autoload.php* in the root path of a mdcms theme. Furthermore, you should write code to detect and compile you dependencies automatically.

Here is a pseudo sample code:

(Pending)

### Build Scripts for Front End Assets

The Gulp build scripts in default theme of mdcms is not really a part of a mdcms theme. You may delete them, adding your own build scripts for the front end stacks of your theme. Automate your compilation so that you can invoke the whole process in a single command.
