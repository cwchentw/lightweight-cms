# Lightweight CMS

**Lightweight CMS** is a dual-mode, flat-file CMS powered by PHP. It supports both static and dynamic rendering, giving developers full control over content, layout, and deployment.

## Features

- Cross-platform
- Uses vanilla PHP as both core logic and templating language — familiar to most web developers
- Toggle between static site generation and dynamic PHP-powered website
- Multilingual site support
- Write content in [Markdown](https://github.github.com/gfm/), [AsciiDoc](https://asciidoc.org/), [reStructuredText](https://docutils.sourceforge.io/rst.html), or plain HTML
- Write dynamic pages in PHP
- Draft post support
- Nested sections
- Breadcrumb navigation
- Pagination
- Table of Contents
- Interlinked tags
- Image lazy loading
- SEO-friendly (disables external link following)
- Sitemap and RSS feed generators
- Progressive Web App support
- Asset compilation, live watching, and hot reload

## Quick Start

### Windows

```sh
choco install php --version=8.1.21
choco install composer
choco install nodejs --version=18.17.0
choco install rsync
choco install sed

git clone https://github.com/cwchentw/lightweight-cms.git mysite
cd mysite
git checkout master
./tools/bin/serve.bat
```

### macOS

```sh
brew install php@8.1
brew install composer
brew install node@18

git clone https://github.com/cwchentw/lightweight-cms.git mysite
cd mysite
git checkout master
./tools/bin/serve
```

### Ubuntu

```sh
sudo apt install php php-xml php-mbstring php-zip unzip

curl -o composer-setup.php https://getcomposer.org/installer
php composer-setup.php --install-dir=$HOME/bin --filename=composer

# Install Node.js via nvm
nvm install 18.17.0
nvm use 18.17.0

git clone https://github.com/cwchentw/lightweight-cms.git mysite
cd mysite
git checkout master
./tools/bin/serve
```

## Why Not Use Another Static Site Generator?

There are already many static site generators — but this CMS bridges a unique gap:

- Full flat-file content management, **without a database**
- Uses **PHP as both logic and template language** — no DSL to learn
- Seamlessly switches between static and dynamic modes
- Ideal for hybrid content sites (e.g., documentation + light app features)

It started from Hugo-inspired concepts and evolved into a pragmatic platform for developers who prefer writing in familiar tools.

## System Requirements

### Back End

- PHP 8.0 or 8.1 (CLI and web server)
- GNU/Linux recommended (macOS/Windows supported)
- Composer
- Optional: AsciiDoctor (AsciiDoc), Docutils + Pygments (reStructuredText), Perl (replacement)

### Front End

- Node.js 18.x
- Gulp, Sass, Babel, Autoprefixer, stylelint, Flow
- Normalize.css, Bootstrap 5, Bootstrap.Native
- Optional: highlight.js

(Dependencies are theme-based; the default and multilingual themes require the above.)

## Builtin Themes

- `default`: documentation layout
- `multilingual`: documentation with i18n
- `blog`: blog-style layout

Set `SITE_MODE` in `config/parameters.php` to `blog` or `documentation`.

## Deployment

To deploy your CMS:

```bash
./tools/bin/sync-to /path/to/www
```

Set up web server configs accordingly (see `/tools/etc/nginx.conf` for sample).

## Want to Contribute or Learn More?

This project is lightly maintained, but real-world ready. Clone, experiment, and adapt as needed. Questions and discussions welcome via GitHub Issues.

## License

MIT License © 2023 ByteBard
