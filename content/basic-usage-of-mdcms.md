# Basic Usage of mdcms

## Prologue

This article illustrates the basic usage of mdcms. Some details are omitted for brevity. We will introduce them in other posts.

## System Requirements

### Back End

* Production environment
  * GNU/Linux
  * PHP 7.2 or above
  * mbstring extension of PHP
  * [Parsedown](https://github.com/erusev/parsedown) and [Parsedown Extra](https://github.com/erusev/parsedown-extra)
  * [MetaParsedown](https://github.com/pagerange/metaparsedown)
* Development environment
  * [Composer](https://getcomposer.org/)
  * [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) (for linting)
  * [PHPMD](https://phpmd.org/) (for linting)

If you are not interested in developing mdcms itself, you still require Composer to install other dependency packages for mdcms.

### Front End

* Production environment
  * A [modern browser](https://browsehappy.com/) like Chrome and Firefox
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
  * [ESLint](https://eslint.org/)

Currently, we utilize Sass as CSS preprocessor and Babel with Flow as JavaScript transcompiler. If you prefer other front end stacks over our choices, you may completely remove these development tools and configurations, adding your own. They are independent of mdcms itself.

