---
title: 撰寫文章
mtime: 2022/09/16
weight: 3
---

## 前言

即將成為偉大的內容型網站的擁有者，你等不及要撰寫和發佈文章到網站上。本文說明如何在 Lightweight CMS 網站撰寫文章。

## 選擇程式編輯器

對主流輕量級標記語言的編輯器外掛很常見。主要編輯器應該都可以勝任撰寫文章的任務。[VS Code](https://code.visualstudio.com/) 是免費且跨平台的編輯器，在網頁程式設計師間很受歡迎，也適合用來撰寫 Markdown、AsciiDoc 和 reStructuredText 文檔。

## 儲存文章

文章儲存在內容目錄，預設值為 *content* 。

若想要更新 Lightweight CMS 快照，你應該將文章存到 *content* 以外的目錄。參考這篇[指引](/zh-tw/howto/upgrade-lightweight-cms/)以取得更多資訊。

Lightweight CMS 網站支援的文檔格式為 [Markdown](https://github.github.com/gfm/)、[AsciiDoc](https://asciidoc.org/)、[reStructuredText](https://docutils.sourceforge.io/rst.html) 和 HTML。

## 文章和網址的關連性

由於 Lightweight CMS 是平面文件內容管理系統，其網址會直接對應到內容目錄的子目錄和文檔。以下是兩者間的對映：

|File Format     |Path                               |
|----------------|-----------------------------------|
|URL             |`https://example.com/section/post/`|
|Markdown        |*content/section/post.md*          |
|AsciiDoc        |*content/section/post.adoc*        |
|reStructuredText|*content/section/post.rst*         |
|HTML            |*content/section/post.html*        |

也支援嵌套章節中的文章。以下是其對映：

|File Format     |Path                                          |
|----------------|----------------------------------------------|
|URL             |`https://example.com/section/subsection/post/`|
|Markdown        |*content/section/subsection/post.md*          |
|AsciiDoc        |*content/section/subsection/post.adoc*        |
|reStructuredText|*content/section/subsection/post.rst*         |
|HTML            |*content/section/subsection/post.html*        |

## 撰寫 Markdown 文章

原本 Markdown 的特性較侷限。有數個 Markdown 變體擴展了這個小型標記語言。Lightweight CMS 支援的 Markdown 方言為 [GFM (GitHub-flavored Markdown)](https://github.github.com/gfm/)，這個語言即為 GitHub 線上編輯器使用的 Markdown 方言。

Here shows a pseudo Markdown post:

```markdown
# A Markdown Post

A paragraph with some text.

Another paragraph with some text.
```

Because of limited page size, we won't repeat syntax of GFM here. Refer to its official spec for more information.

## 撰寫 AsciiDoc 文章

*Experimental*

Because Markdown syntax is limited in feature, we add [AsciiDoc](https://asciidoc.org/) as an alternative. [AsciiDoctor](https://asciidoctor.org/) is required on the host environment to render AsciiDoc post(s).

We modify the templates of ordered list, unordered list, `<img>` tag and `<audio>` tag to add class(es) on these tags while keeping the same semantic structure(s) set by AsciiDoc.

Because the limitations by AsciiDoctor, all AsciiDoc posts in our system start at `<h2>`-level titles. Titles in front matters are required for post top headings.

## 撰寫 reStructuredText 文章

*Experimental*

As above, Markdown is feature-limited; therefore, we add [reStructuredText](https://docutils.sourceforge.io/rst.html) for complex posts unmet in Markdown. [Docutils](https://docutils.sourceforge.io/index.html) is required on the host environment for reStructuredText rendering. [Pygments](https://pygments.org/) is needed as well for code highlighting in reStructuredText posts.

Because the limitations by Docutils, all reStructuredText posts in our system start at `<h2>`-level titles. Titles in front matters are required for post top headings.

## 撰寫 HTML 文章

In addition to writing posts in lightweight markup languages supported by our software, you can write vanilla HTML posts as well. When writing such posts, **DON'T** write full HTML pages:

```html
<!-- DON'T write a full HTML page. -->
<!DOCTYPE>
<html>
<head>
  <title>A HTML Post</title>
</head>
<body>
  <h1>A HTML Post</h1>

  <p>A paragraph with some text.</p>

  <p>Another paragraph with some text.</p>
</body>
</html>
```

 Instead, write which between a pair of `<body>` tags:

 ```html
<!-- Write which between <body> tags instead. -->
<h1>A HTML Post</h1>

<p>A paragraph with some text.</p>

<p>Another paragraph with some text.</p>
 ```

Because Lightweight CMS renders web pages for you, you don't require to write everything from scratch.

## 撰寫文章標題

You may write a title of a post in the following region (by precedence):

* `title` field in front matter of a post
* `<h1>` tag equivalent in a post (in Markdown and HTML posts)
* File name

If there is no title in a post, Lightweight CMS will generate one dynamically based on file name of a post. In such case, you should name your post files in kebab case like `title-of-awesome-post`.

## 前頁

前頁 (front matter) are optional YAML text regions in top of posts. Such regions intend for metadata of posts that are difficult or unable to retrieve from post files directly.

Here represents a Markdown post with a front matter:

```markdown
---
title: A Markdown Post
author: Michelle Chen
mtime: 2021/06/08
description: A concise description for a post
---

A paragraph with some text.

Another paragraph with some text.
```

Here are the exposed fields of front matters if available:

* `title`
* `author`
* `mtime`
* `weight`

Those fields are not hard coded but adjustable in *setting.php*.

In addition, all fields in a front matter are exposed in `$post[LIGHTWEIGHT_CMS_POST_METADATA]`.

A front matter in an AsciiDoc post is supported in this way, not by its native front matter format:

```asciidoc
---
title: An AsciiDoc Post
mtime: 2022/07/20
---

Some text here.
```

## (選擇性) 增加章節的內容

Sections in Lightweight CMS intend for intermediaries to posts merely. They seldom benefit site SEO. Nevertheless, you may still add content for sections as needed.

Contents for sections are written in *_index.md*. Write it as ordinary Markdown posts.
