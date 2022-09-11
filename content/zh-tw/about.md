---
title: 關於本軟體
mtime: 2022/09/11
weight: 1
---

## 兼具動態和靜態

[Lightweight CMS (輕量級內容管理系統)](https://github.com/cwchentw/lightweight-cms)是兼具靜態和動態的**平面文件 (flat-file)** **內容管理系統 (content management system)**，以 PHP 驅動。

根據內容管理系統輸出網頁的方式，內容管理系統可能是靜態或動態的。[WordPress](https://wordpress.org/) 是世上最知名的動態內容管理系統；[Jekyll](https://jekyllrb.com/) 和 [Hugo](https://gohugo.io/) 則是知名的靜態內容管理系統。

動態內容管理系統具有彈性，有需求時易於新增特性；但消耗更多的運算資源，因為這些系統每次輸出網頁時都是即時運算的。相對來說，靜態內容管理系統可以節約預算，但難以客製化，這是由於靜態網站的限制。大部分內容管理系統只能是靜態或動態的，從其中一種模式轉換到另一個模式相當麻煩。

我們的內容管理系統，Lightweight CMS，兼具靜態和動態模式。從其中一個模式轉換到另一個模式相當容易。如果目前網站不需要動態性，Lightweight CMS 網站可以編譯成靜態網站。若之後需要客製化，Lightweight CMS 基於 PHP，這是製作動態網站最受歡迎的程式語言。 

## 輕量級標記語言

大部分靜態內容管理系統將內容儲存在 Markdown 文檔中。我們則支援更多標記語言。本軟體的內容可存成 [Markdown](https://github.github.com/gfm/)、[AsciiDoc](https://asciidoc.org/)、[reStructuredText](https://docutils.sourceforge.io/rst.html) 或 HTML。

我們的做法結合兩種系統的優勢。Lightweight CMS 網站的頁面是動態輸出的，對頁面的修改會即時反映。網站站長可使用**輕量級標記語言 (lightweight markup language)** 撰寫文件，不需使用某種**富文字編輯器 (rich-text editor)**。平面文件比資料庫轉儲易於備份和回復，以及整合進像是 [Git](https://git-scm.com/) 的**版本控制系統 (version control system)** 中。

## 內容快取

隨著 [Cloudflare](https://www.cloudflare.com/) 等 **CDN 服務 (CDN service)** 的問世，對內容做快取幾乎不需要費力，不論網站是靜態還是動態的。由於這些服務，靜態網站對**內容快取 (content caching)** 不再重要。此外，靜態網站能製作旳網站類型是受限的，像是會員網站或是部落格和網頁程式混合型網站皆無法製作。

## 繼續深入

在[這裡](/reference/concept/)閱讀 Lightweight CMS 的概念。.

這個網站本身就是 Lightweight CMS 的即時展示。此網站包含 GNU/Linux、Nginx 和 PHP 的經典組合。
