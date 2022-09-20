---
title: 章節和文章的訣竅
linkTitle: 章節和文章
description: "本文說明關於章節和文章的訣竅。"
mtime: 2022/09/12
weight: 1
---

## 前言

本文說明關於章節和文章的訣竅。

## 在標題加入一對方括號

Quote the title with a pair of `"` like this:

```markdown
---
title: "[Golang] Build Development Environment"
---
```

## 為頁面加上額外欄位

Besides builtin fields exposed in sections and posts, Lightweight CMS expose metadata as PHP arrays as well.

Let's say we add a subtitle in addition to a title:

```markdown
---
title: A Markdown Post
subtitle: A Post with a Subtitle
---
```

Because `subtitle` is not a builtin field, access it in a metadata array like `$post[LIGHTWEIGHT_CMS_POST_META]["subtitle"]`.

## 遷移頁面

Because HTML is static and logic-less, it is impossible to migrate a page merely with it. Instead, you can add a short JavaScript code like this:

```markdown
---
title: A Legacy Post
---

<script>
window.location.href = "/path/to/new/uri/";
</script>
```

Once visitors access this page, the code will direct them to a new location. Such code may be used for posts or index files of sections.

## 使用章節和文章以外的版面

It is unlikely theme creators can produce extra layouts in advance to fulfill unseen needs. Therefore, Lightweight CMS allows site owners to write custom pages instead of regular posts. Because of limited page size, we won't review the details to create custom pages here.

## 撰寫網頁程式而非文章

If you want to write a web application instead of a regular post, you may implement your application in a HTML page if layout of posts is acceptable. In contrary, you may write a custom page instead of a post if you need a custom layout or a HTML form.
