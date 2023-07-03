---
title: How to Migrate Posts
linkTitle: Migrate Posts
mtime: 2023/6/1
weight: 3
---

## The Story

The posts on your site may be no longer appropriate for some reasons

* The content of a post becomes outdated
* The title or the content of a post is not attractive by SEO means
* The niche of your site is changing
* Anything else

No matter what the reason is, you should migrate your posts for better SEO. This article introduces possible moves and their effects on your site.

## Hide Posts

To hide a post, set the post as a draft in the front matter of the post:

```markdown
---
draft: true
---
```

The move will introduce a HTTP 404 (page not found) error when site users visit the page, harming your SEO somehow. It only makes sense when the post itself already harms your site ranking and you don't want to update it.

## Remove Posts from Search Engine Indexing

To remove a post from search engine indexing, set a `noindex` flag in the front matter of the post:

```markdown
---
noindex: true
---
```

The post will disappear from search engine result pages but your visitors are still able to access it. When you don't bother updating a post, keep it *as is* for the old visitors.

## Redirect Posts

The post still owns some value but it is not attractive currently. You may redirect your post to a more SEO-friendly URL.

Let's say here is a post to introduce the structure of a piano keyboard as a note interval ruler for music theory learning:

* `/misc/piano-keyboard/`

Nevertheless, the URL is not good enough for SEO obviously. We want to redirect the original post to a new URL:

* `/music-theory/learn-music-theory-with-piano-keyboard/`

Rename your old post file to a new URL:

* */posts/music-theory/learn-music-theory-with-piano-keyboard.md*

The move will introduce a HTTP 404 (page not found) error because the original URL is missing a corresponding file.

To solve the issue, create a html file in */posts/misc/piano-keyboard.html*:

```html
---
title: The Original Title of Your Post
noindex: true
---

<script>
    window.location.href = "/music-theory/learn-music-theory-with-piano-keyboard/";
</script>
```

When your visitors access the original page, the functional page will redirect them to your new page. No HTTP 404 error will occur.

## (Bonus) Migrate Sections

The tricks introduced here apply for the sections of your site as well. Modify the *_index.md* of a section accordingly to fit your need.
