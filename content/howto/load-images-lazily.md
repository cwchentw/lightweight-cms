---
title: How to Load Images Lazily
linkTitle: Load Images Lazily
mtime: 2023/07/11
weight: 4
---

## Prologue

Image lazy loading, an optional feature for the Web, keeps images from loading before the users scroll to them.

## Basic Usage

* Enable `ENABLE_IMAGE_LAZY_LOADING` the paramater
* Use `<img>` tag to load the image
* Add `lazy` the class to the tag
* DON'T set the image path in `src` of the tag
* Set the path of the image in `data-src` the attribute of the tag

## Samples in Different Markup Languages

### Markdown

Markdown doesn't provide proper way to add data attribute to its image syntax. Hence, use a vanilla `<img>` tag instead:

```markdown
<img class="lazy" src="" data-src="/path/to/image.png" alt="Brief description for the image">
```

### AsciiDoc

The block image template for `<img>` tag in AsciiDoc is modified in Lightweight; therefore, its image macro is aware of `data-src` the attribute:

```asciidoc
[.lazy]
image::&#8203;[Brief description for the image,data-src="/path/to/image.png"]
```

`&#8203;` means a zero space character as a filler for the image source in block image macro.

### reStructuredText

Image directive of reStructuredText doesn't supply data attribute. To address the issue, use a raw HTML directive instead:

```rst
... raw:: html

    <img class="lazy" src="" data-src="/path/to/image.png" alt="Brief description for the image">
```
