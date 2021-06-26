---
title: Write Posts on mdcms Sites
mtime: 2021/6/26
weight: 3
---

## Prologue

As a would-be owner of an awesome content website, you cannot wait to write and publish posts. This article illustrates how to write posts on mdcms-based sites.

## Choose a Programming Editor

Markdown represents a simple and lightweight markup language without programming logic. Any programming editor should suffice. [VS Code](https://code.visualstudio.com/), a free and cross-platform editor, is popular among web programmers and suitable for Markdown as well.

## Save Posts

Posts are saved in a content directory, which default is *content*.

If you are going to upgrade your mdcms snapshot, you should save posts to a directory other than *content*. See [this guide](/howto/how-to-upgrade-mdcms/) for more information.

Valid file formats for posts in mdcms sites are Markdown and HTML.

## The Relationship between Posts and URLs

Because mdcms is a flat-file based content management system, URLs in a mdcms site map to directories and files in *content* directory directly. Here represents a pseudo URL:

```
https://example.com/section/post/
```

Such URL will map to either *content/section/post.md* or *content/section/post.html*.

Nested sections for a post are allowed as well. Here shows a pseudo URL with such a post:

```
https://example.com/section/subsection/post/
```

Such URL will map to either *content/section/subsection/post.md* or *content/section/subsection/post.html*.

## Write Markdown Posts

The feature set of original Markdown is limited. There are several variants of Markdown extending the capacity of this small markup language. The Markdown dialect supported by mdcms is [GitHub-flavored Markdown](https://github.github.com/gfm/) (GFM), which is used by online editor of GitHub.

Here shows a pseudo Markdown post:

```markdown
# A Markdown Post

A paragraph with some text.

Another paragraph with some text.
```

Because of limited page size, we won't repeat syntax of GFM here. Refer to its official spec for more information.

## Write HTML Posts

In addition to writing Markdown posts, you can write vanilla HTML posts as well. When writing such posts, don't write full HTML pages:

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
 
Because mdcms renders web pages for you, you don't require to write everything from scratch.
 
## Write Titles for Posts

You may write title of a post in the following region (by precedence):

* `title` field in front matter of a post
* `<h1>` tag equivalent in a post
* File name

If there is no title in a post, mdcms will generate one dynamically based on file name of a post. In such case, you should name your post files in kebab case like `title-of-awesome-post`.

## Front Matters of Posts

Front matters are optional YAML text regions in top of posts, either Markdown or HTML ones. Such regions intend for metadata of posts that are difficult or unable to retrieve from post files directly.

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

Here are exposed fields of front matters:

* `title`
* `author`
* `mtime`
* `description` (not implemented yet)
* `weight` (not implemented yet)

Those fields are not hard coded but adjustable in *setting.php*.

In addition, all fields in a front matter are exposed in `$post[MDCMS_POST_METADATA]` (not implemented yet).

## (Optional) Add Contents for Sections

Sections in mdcms intend for intermediaries to posts merely. They seldom benefit site SEO. Nevertheless, you may still add content for sections as needed.

Contents for sections are written in *_index.md*. Write it as ordinary Markdown posts.
