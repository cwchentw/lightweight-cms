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

這裡展示假想的 Markdown 文檔：

```markdown
# A Markdown Post

A paragraph with some text.

Another paragraph with some text.
```

由於篇幅限制，我們不會說明 GFM 的語法。請參考其官方文件。

## 撰寫 AsciiDoc 文章

*實驗性質*

由於 Markdown 語法特性侷限，我們新增 [AsciiDoc](https://asciidoc.org/) 做為替代的標記語言。托管環境需要安裝 [AsciiDoctor](https://asciidoctor.org/) 以輸出 AsciiDoc 文檔。

我們修改了有序清單、無序清單、`<img>` 標籤、`<audio>` 標籤的模板。這是為了在這些標籤上新增 CSS 類別，並保存 AsciiDoc 原本的語義架構。

由於 AsciiDoctor 的限制，所有的 AsciiDoc 文章從 `<h2>` 層級標題起算。前頁的大標題是必需的。

## 撰寫 reStructuredText 文章

*實驗性質*

同上，Markdown 語法特性上受到侷限，故我們新增 [reStructuredText](https://docutils.sourceforge.io/rst.html) 以處理複雜格式的文章，而這些文章無法以 Markdown 處理。托管環境需要安裝 [Docutils](https://docutils.sourceforge.io/index.html) 以輸出 reStructuredText 文檔。此外，若需要語法高亮，需要安裝 [Pygments](https://pygments.org/)。

由於 Docutils 的限制，所有的 reStructuredText 文章從 `<h2>` 層級標題起算。前頁的大標題是必需的。

## 撰寫 HTML 文章

除了使用本軟體支援的輕量級標記語言，也可以直接用 HTML 撰寫文檔。撰寫 HTML 文檔時，**不要**撰寫整個 HTML 頁面：

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

只寫出 `<body>` 內的文字及標籤即可：

 ```html
<!-- Write which between <body> tags instead. -->
<h1>A HTML Post</h1>

<p>A paragraph with some text.</p>

<p>Another paragraph with some text.</p>
 ```

這是因為 Lightweight CMS 會自行輸出頁面，不需要從頭撰寫網頁。

## 撰寫文章標題

可以在以下區域撰寫文章標題 (按優先順序排列)：

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
