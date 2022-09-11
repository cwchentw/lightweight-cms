---
title: Tips to Sections and Posts
linkTitle: Sections and Posts
mtime: 2022/1/30
weight: 1
---

## Prologue

This article illustrates tips to sections and posts.

## Add a Pair of Square Brackets to a Title

Quote the title with a pair of `"` like this:

```markdown
---
title: "[Golang] Build Development Environment"
---
```

## Add Extra Fields for Pages

Besides builtin fields exposed in sections and posts, Lightweight CMS expose metadata as PHP arrays as well.

Let's say we add a subtitle in addition to a title:

```markdown
---
title: A Markdown Post
subtitle: A Post with a Subtitle
---
```

Because `subtitle` is not a builtin field, access it in a metadata array like `$post[LIGHTWEIGHT_CMS_POST_META]["subtitle"]`.

## Migrate a Page

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

## Use Layouts other than Sections and Posts

It is unlikely theme creators can produce extra layouts in advance to fulfill unseen needs. Therefore, Lightweight CMS allows site owners to write custom pages instead of regular posts. Because of limited page size, we won't review the details to create custom pages here.

## Write a Web Application instead of a Post

If you want to write a web application instead of a regular post, you may implement your application in a HTML page if layout of posts is acceptable. In contrary, you may write a custom page instead of a post if you need a custom layout or a HTML form.
