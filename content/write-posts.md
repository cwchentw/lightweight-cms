---
title: Write Posts on mdcms Sites
mtime: 2021/6/18
---

## Prologue

As a would-be owner of an awesome content website, you cannot wait to write and publish posts. This article illustrates how to write posts on mdcms-based sites.

## Choose a Programming Editor

Markdowns represents a simple and lightweight markup language without programming logic. Any programming editor will suffice. [VS Code](https://code.visualstudio.com/), a free and cross-platform editor, is popular among programmers and suitable for Markdown as well.

## Save Posts

Posts are saved in a content directory, which default is *content*. You may change the name of a content directory with **CONTENT_DIRECTORY** the variable in *setting.php*.

The file formats of posts in mdcms sites are either Markdown or HTML.

## The Relationship between Posts and URLs

Because mdcms is a flat file based content management system, the URLs in a mdcms site map to the directories and files in a content directory directly. Here represents a pseudo URL:

```
https://example.com/section/post/
```

Such URL will map to either *content/section/post.md* or *content/section/post.html*.

Nested sections are allowed as well. Here shows a pseudo URL with such sections:

```
https://example.com/section/subsection/post/
```

Such URL will map to either *content/section/subsection/post.md* or *content/section/subsection/post.html*.

## Write Markdown Posts

The feature set of original Markdown is limited. There are several variants of Markdown extending the capacity of this small markup language. The Markdown dialect supported by mdcms is [GitHub-flavored Markdown](https://github.github.com/gfm/) (GFM), which is used on the online editor of GitHub.

Here shows a pseudo Markdown post:

```markdown
# A Markdown Post

A paragraph with some text.

Another paragraph with some text.
```

Because of limited page size, we won't repeat the syntax of GFM here. Refer to its official spec for more.

## Write HTML Posts

In addition to writing Markdown posts, you can write vanilla HTML posts as well. When writing such posts, don't write full HTML pages:

```html
<!-- Don't write a full HTML page. -->
<!DOCTYPE>
<html>
<head>
  <title>A HTML Post</title>
</head>
<body>
  <h1>A HTML Post</h1>

  <p>Some text here</p>
</body>
</html>
```

 Instead, write which between a pair of `<body>` tags:
 
 ```html
<!-- Write content between <body> tags. -->
<h1>A HTML Post</h1>

<p>Some text here</p>
 ```
 
 Because mdcms renders web pages for you, you don't require to write everything from scratch.
 
## Write Titles for Posts

If you write a title in a post, the title will be rendered on the web page *as is*. In contrary, if there is no title in a post, mdcms will generate one dynamically according to the file name of the post.

## Front Matters of Posts

Front matters are optional YAML text regions in the top of posts, either Markdown or HTML ones. Such regions intend for metadata of posts that are difficult or unable to retrieve from post files directly.

Here represents a Markdown post with a front matter:

```markdown
---
title: A Markdown Post
author: Michelle Chen
description: A concise description for a post
date: 2021-06-08
---

A paragraph with some text.

Another paragraph with some text.
```
