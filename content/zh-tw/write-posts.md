---
title: 撰寫文章
mtime: 2022/09/17
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

* 前頁的 `title` 欄位
* 文章的 `<h1>` 等效標籤 (僅限 Markdown 和 HTML 文檔)
* 檔案名稱

若文檔沒有標題，Lightweight CMS 會自動從檔案名稱產生文章標題。這時候，你應該用烤肉串命名法 (kebab case) 來命名檔案，像是 `title-of-awesome-post` *(註)* 。

*(註) 這是針對英文文檔的考量*

## 前頁

前頁 (front matter) 是位於文檔頂端、可選擇性的 YAML 文字區塊。其用途是文件的元資料，這些資料無法直接從文檔中取得。

以下是一篇 Markdown 文檔的前頁：

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

以下是前頁會外露到變數的欄位：

* `title`
* `author`
* `mtime`
* `weight`

這些欄位的名稱可在 Lightweight CMS 的內部設定中調整。

此外，所有的欄位都外露到 `$post[LIGHTWEIGHT_CMS_POST_METADATA]` 陣列中。

AsciiDoc 的前頁採用和此處相同的格式，而非 AsciiDoc 原生前頁格式：

```asciidoc
---
title: An AsciiDoc Post
mtime: 2022/07/20
---

Some text here.
```

## (選擇性) 增加章節的內容

Lightweight CMS 的章節僅是文章的過渡頁面，對網站 SEO 幾無幫助。然而，你仍然可為章節新增內容。

章節的內容寫在 *_index.md* 文檔中。該文檔等同於一般的 Markdown 文檔。
