---
title: 如何建立 Lightweight CMS 佈景主題
linkTitle: 建立 Lightweight CMS 佈景主題
mtime: 2022/09/12
weight: 5
---

## 前言

This guide illustrates to create a Lightweight CMS theme, taking [default theme](https://github.com/cwchentw/lightweight-cms/tree/master/themes/default) of Lightweight CMS as an instance.

## 專案架構

Here we list project structure of *default* theme of Lightweight CMS:

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

*assets* directory places front end assets of a Lightweight CMS theme. In *default* theme, the directory includes [Babel](https://babeljs.io/) and [Scss](https://sass-lang.com/) code.

Babel code is vanilla JavaScript. Nevertheless, we still transcompile it for compatibility with older browsers. In contrary, Sass code is unusable before compiling to corresponding CSS one.

*build* directory composes of Gulp build scripts. If you want to employ other build automation system, you require to write your own.

*theme* and *partials* are layouts of *default* theme. To simplify the code base, these layouts are written in PHP instead of other template language.

*src* are small PHP scripts used by this theme. Mandatory functions for a Lightweight CMS theme are included in these scripts as well.

*.browserlistrc*, *.eslintrc*, *.flowconfig* and *.stylelintrc* are configurations for front end assets of *default* theme.

None of these are mandatory for a Lightweight CMS theme. The only required file is *autoload.php* in root path of a Lightweight CMS theme. See next section for more information.

## *autoload.php*

Project structure of a Lightweight CMS theme is very liberal. *autoload.php* is the only mandatory file for a Lightweight CMS theme. The script should always be located in root path of a Lightweight CMS theme. You may either implement required functions within it or load another PHP script.

## 佈景主題的必要函式

### `loadHome()` 函式

The essential function to load layout for home page in a Lightweight CMS site. It receives no parameter. Theme creators are responsible to load a layout for home page properly.

Here is a sample code:

```php
function loadHome()
{
    # Get the root path of default theme of Lightweight CMS.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "theme" . $sep . "home.php";
}

```

It is recommended to use `require` instead of `include` here because it should be an error unable to load a layout properly.

### `loadSection()` 函式

The necessary function to load layout for sections in a Lightweight CMS site. In a similiar fashion, it receives no parameter. Here shows an example:

```php
function loadSection()
{
    # Get the root path of default theme of Lightweight CMS.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "theme" . $sep . "section.php";
}
```

Lightweight CMS doesn't distinguish between top sections and nested ones. Therefore, only one function is needed here.

### `loadPost()` 函式

The mandatory function to load layout for posts in a Lightweight CMS site. No parameter is needed. Here shows a sample code:

```php
function loadPost()
{
    # Get the root path of default theme of Lightweight CMS.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

    require $rootDirectory . $sep . "theme" . $sep . "post.php";
}
```

### `loadAssets($dest)` 函式

The function to copy assets in a theme to a destination path specified by Lightweight CMS. Unlike other functions here, it receives one parameter, which represents a destination path.

*Default* theme of Lightweight CMS utilize Sass and Babel as its front end stacks. Code written in the two languages requires compilation before deploying to production environments.

Here is the function used by *default* theme of Lightweight CMS:

```php
function loadAssets($dest)
{
    # Save the path of old working directory.
    $oldDirectory = getcwd();

    # Get the root path of default theme of Lightweight CMS.
    $sep = DIRECTORY_SEPARATOR;
    $rootDirectory = __DIR__ . $sep . "..";

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
        $publicDirectory = $rootDirectory . $sep . "public";

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

You should not copy and paste the code here to your own theme. Instead, modify it according to your situation.

## 必要的版面

Here we list sample layouts used in Lightweight CMS themes:

* Layout for [home page](https://github.com/cwchentw/lightweight-cms/blob/master/themes/default/layout/home.php)
* Layout for [sections](https://github.com/cwchentw/lightweight-cms/blob/master/themes/default/layout/section.php)
* Layout for [posts](https://github.com/cwchentw/lightweight-cms/blob/master/themes/default/layout/post.php)

Check exposed variables in these layouts [here](/zh-tw/reference/variable-in-layout/).

## 撰寫佈景主題的最佳實務

### 避免命名空間

Rounter of Lightweight CMS views these required functions as global ones. Therefore, don't add any namespace in required  functions.

### 載入第三方函式庫

You may need features other than those in the core library of Lightweight CMS. If you need any third-party library, you should load them in the main loader, i.e. *autoload.php* in root path of a Lightweight CMS theme. Furthermore, you should write code to detect and compile you dependencies automatically.

### 為靜態資產寫編譯腳本

Gulp build scripts in *default* theme of Lightweight CMS is not a required part of a Lightweight CMS theme. You may delete them, adding your build scripts for front end stacks of your theme. Automate your compilation so that you can invoke the whole process in a single command.
