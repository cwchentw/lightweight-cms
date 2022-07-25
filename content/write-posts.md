---
title: Write Posts
mtime: 2022/07/25
weight: 3
---

## Prologue

As a would-be owner of an awesome content website, you cannot wait to write and publish posts for your site. This article illustrates how to write posts on Lightweight CMS based sites.

## Choose a Programming Editor

Plugins or extensions for popular lightweight markup languages are commonplace. Any programming editor should suffice. [VS Code](https://code.visualstudio.com/), a free and cross-platform editor, is popular among web programmers and suitable for Markdown, AsciiDoc and reStructuredText as well.

## Save Posts

Posts are saved in a content directory, which default to *content*.

If you are going to upgrade your Lightweight CMS snapshot, you should save posts to a directory other than *content*. See [this guide](/howto/how-to-upgrade-mdcms/) for more information.

Valid file formats for posts in Lightweight CMS sites are [Markdown](https://github.github.com/gfm/), [AsciiDoc](https://asciidoc.org/), [reStructuredText](https://docutils.sourceforge.io/rst.html) and HTML.

## The Relationship between the Posts and the URLs

Because Lightweight CMS is a flat-file based content management system, URLs in a Lightweight CMS site map to directories and files in *content* directory directly. Here represents a pseudo URL and file mapping:

|File Format     |Path                               |
|----------------|-----------------------------------|
|URL             |`https://example.com/section/post/`|
|Markdown        |*content/section/post.md*          |
|AsciiDoc        |*content/section/post.adoc*        |
|reStructuredText|*content/section/post.rst*         |
|HTML            |*content/section/post.html*        |

Nested sections for a post are allowed as well. Here shows its mapping:

|File Format     |Path                                          |
|----------------|----------------------------------------------|
|URL             |`https://example.com/section/subsection/post/`|
|Markdown        |*content/section/subsection/post.md*          |
|AsciiDoc        |*content/section/subsection/post.adoc*        |
|reStructuredText|*content/section/subsection/post.rst*         |
|HTML            |*content/section/subsection/post.html*        |

## Write Markdown Posts

The feature set of original Markdown is limited. There are several variants of Markdown extending the capacity of this small markup language. The Markdown dialect supported by Lightweight CMS is [GitHub-flavored Markdown](https://github.github.com/gfm/) (GFM), which is used by online editor of GitHub.

Here shows a pseudo Markdown post:

```markdown
# A Markdown Post

A paragraph with some text.

Another paragraph with some text.
```

Because of limited page size, we won't repeat syntax of GFM here. Refer to its official spec for more information.

## Write AsciiDoc Posts

*Experimental*

Because Markdown syntax is limited in feature, we add [AsciiDoc](https://asciidoc.org/) as an alternative. [AsciiDoctor](https://asciidoctor.org/) is required on the host environment to render AsciiDoc post(s).

We modify the templates of ordered list, unordered list, `<img>` tag and `<audio>` tag to add class(es) on these tags while keeping the same semantic structure(s) set by AsciiDoc.

Because the limitations by AsciiDoctor, all AsciiDoc posts in our system start at `<h2>`-level titles. Titles in front matters are required for post top headings.

## Write reStructuredText Posts

*Experimental*

As above, Markdown is feature-limited; therefore, we add [reStructuredText](https://docutils.sourceforge.io/rst.html) for complex posts unmet in Markdown. [Docutils](https://docutils.sourceforge.io/index.html) is required on the host environment for reStructuredText rendering. [Pygments](https://pygments.org/) is needed as well for code highlighting in reStructuredText posts.

Because the limitations by Docutils, all reStructuredText posts in our system start at `<h2>`-level titles. Titles in front matters are required for post top headings.

## Write HTML Posts

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

## Write Titles for Posts

You may write a title of a post in the following region (by precedence):

* `title` field in front matter of a post
* `<h1>` tag equivalent in a post (in Markdown and HTML posts)
* File name

If there is no title in a post, Lightweight CMS will generate one dynamically based on file name of a post. In such case, you should name your post files in kebab case like `title-of-awesome-post`.

## Front Matters of Posts

Front matters are optional YAML text regions in top of posts. Such regions intend for metadata of posts that are difficult or unable to retrieve from post files directly.

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

## (Optional) Add Contents for Sections

Sections in Lightweight CMS intend for intermediaries to posts merely. They seldom benefit site SEO. Nevertheless, you may still add content for sections as needed.

Contents for sections are written in *_index.md*. Write it as ordinary Markdown posts.
