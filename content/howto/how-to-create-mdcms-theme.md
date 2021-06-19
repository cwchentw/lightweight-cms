---
title: How to Create a mdcms Theme
mtime: 2021/6/19
---

## Prologue

This guide illustrates to create a mdcms theme, taking [default theme](https://github.com/cwchentw/mdcms/tree/master/themes/default) of mdcms as an instance.

## Project Structure

Here we list the project structure of *default* theme of mdcms:

```shell
$ cd path/to/themes/default
$ tree --dirsfirst -a -L 1
.
├── assets
├── build
├── partials
├── src
├── theme
├── autoload.php
├── .browserlistrc
├── .eslintrc
├── .flowconfig
├── .gitignore
├── package.json
├── package-lock.json
├── README.md
└── .stylelintrc
```

*assets* directory places front end assets. In *default* theme, the directory includes [Babel](https://babeljs.io/) and [Scss](https://sass-lang.com/) code.

Babel code is vanilla JavaScript. Nevertheless, we still transcompile it for compatibility with older browsers. In contrary, Sass code is unusable before compiling to corresponding CSS one.

*build* directory composes of Gulp build scripts. If you want to employ other build automation system, you require to write your own.

*theme* and *partials* are layouts of *default* theme. To simplify the code base, these layouts are written in PHP instead of other template language.

*src* are small PHP scripts used by this theme. Mandatory functions for a mdcms theme are included in these scripts as well.

*.browserlistrc*, *.eslintrc*, *.flowconfig* and *.stylelintrc* are configurations for front end assets of *default* theme.

## *autoload.php*

This PHP script is the only mandatory file of a mdcms theme. The script should always locate in the root path of a mdcms theme. You may either implement required functions within it or load another PHP script.

## Required Functions

### `loadHome()` Function

The essential function to load layout for home page in a mdcms site. It receives no parameter. Theme creators are responsible to load a layout for a home page properly.

Here is a sample code:

```php
function loadHome()
{
    require __DIR__ . "/theme/" . "home.php";
}
```

It is recommended to use `require` instead of `include` here because it should be an error unable to load a layout properly.

### `loadSection()` Function

The necessary function to load layout for sections in a mdcms site. In a similiar fashion, it receives no parameter. Here shows an example:

```php
function loadSection()
{
    require __DIR__ . "/theme/" . "section.php";
}
```

mdcms doesn't distinguish between top sections and nested ones. Therefore, only one function is needed here.

### `loadPost()` Function

The mandatory function to load layout for posts in a mdcms site. No parameter is needed. Here shows a sample code:

```php
function loadPost()
{
    require __DIR__ . "/theme/" . "post.php";
}
```

### `loadPage()` Function

*Not implemented yet*

The mandatory function to load layout for pages in a mdcms site. No parameter is needed. Here shows a sample code:

```php
function loadPost()
{
    require __DIR__ . "/theme/" . "page.php";
}
```

### `loadAssets($dest)` Function

The function to copy assets in a theme to a destination path specified by mdcms. Unlike other functions here, it receives one parameter, which represents a destination path.

*Default* theme of mdcms utilize Sass and Babel as its front end stacks. Code written in the two languages requires compilation before deploying to production environments.

Here is the function used by *default* theme of mdcms:

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

### Layout for Home Page

Here is [a sample layout](https://github.com/cwchentw/mdcms/blob/master/themes/default/theme/home.php) of home page in a mdcms theme.

There are four global variables in this layout:

* `$GLOBALS[MDCMS_SECTIONS]`: An array of top sections of a mdcms site
* `$GLOBALS[MDCMS_POSTS]`: An array of posts without any section of a mdcms site
* `$GLOBALS[MDCMS_CONTENT]` (not implemented yet): A text of optional content of the home page of a mdcms site
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of home page of a mdcms site

### Layout for Sections

Here is [a sample layout](https://github.com/cwchentw/mdcms/blob/master/themes/default/theme/section.php) of sections in a mdcms theme.

There are four global variables in this layout:

* `$GLOBALS[MDCMS_SECTION]`: Current section.
* `$GLOBALS[MDCMS_SECTIONS]`: An array of subsections.
* `$GLOBALS[MDCMS_POSTS]`: An array of posts of current section.
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of current section.

Variables in a subsection (`$section` here):

* `$section[MDCMS_SECTION_TITLE]`: Title of a subsection
* `$section[MDCMS_SECTION_CONTENT]`: Optional content of a subsection
* `$section[MDCMS_SECTION_META]` (not implemented yet): exposed metadata of a subsection

### Layout for Posts

Here represents [a sample layout](https://github.com/cwchentw/mdcms/blob/master/themes/default/theme/post.php) of posts in a mdcms theme.

There are two variables in this layout:

* `$GLOBALS[MDCMS_POST]`: Current post
* `$GLOBALS[MDCMS_BREADCRUMB]`: Breadcrumbs of current post

Variables in this post (`$post` here):

* `$post[MDCMS_POST_TITLE]`: Title of current post
* `$post[MDCMS_POST_CONTENT]`: HTML content of current post
* `$post[MDCMS_POST_AUTHOR]`: Author of current post
* `$post[MDCMS_POST_MTIME]`: Last modified time of current post
* `$post[MDCMS_POST_META]` (not implemented yet): exposed metadata of current post

### Layout for Pages

Pending.

### Variables in an Element of Sections

There are three variables in each element of `$GLOBALS[MDCMS_SECTIONS]` (`$section` here):

* `$section[MDCMS_LINK_PATH]`: Link to a section
* `$section[MDCMS_SECTION_TITLE]`: Title of a section
* `$section[MDCMS_SECTION_EXCERPT]`: A brief description to a section

### Variables in an Element of Posts

Similiarly, there are three variables in each element of `$GLOBALS[MDCMS_POSTS]` (`$post` here):

* `$post[MDCMS_LINK_PATH]`: Link to a post
* `$post[MDCMS_POST_TITLE]`: Title of a post
* `$post[MDCMS_POST_EXCERPT]`: A brief description to a post

## Best Practices to Write a mdcms Theme

### Avoid Namespace

Rounter of mdcms views these required functions as global ones. Therefore, don't add any namespace in required  functions.

### Load Third-Party Libraries

You may need features other than those in the core library of mdcms. If you need any third-party library, you should load them in the main loader, i.e. *autoload.php* in the root path of a mdcms theme. Furthermore, you should write code to detect and compile you dependencies automatically.

### Build Scripts for Front End Assets

Gulp build scripts in *default* theme of mdcms is not a required part of a mdcms theme. You may delete them, adding your own build scripts for front end stacks of your theme. Automate your compilation so that you can invoke the whole process in a single command.
