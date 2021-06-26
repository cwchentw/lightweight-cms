---
title: How to Manage Personal Assets in mdcms
mtime: 2021/6/23
---

## Prologue

In web programming, assets compose of which are placed in front end such as CSS sheets, JavaScript scripts, images and audios. This article discusses asset management is mdcms sites.

## Theme Assets vs Site Assets

There are two levels of assets in mdcms sites. Theme assets mean those used by mdcms themes while site assets used by mdcms sites.

Theme assets are managed by theme creators. You should keep them *as is* unless you want to create or modify a theme. In this place we discuss site assets.

## Keep It in a Static Directionary

If your asset doesn't require processing or compiling before sending to front end, keep it in *static* directory. Those kept in *static* directory will be copied the same way to client environments.

## Keep It in an Asset Directionary

Many front end languages are invented to improve original front end technologies. They are HTML template languages, CSS preprocessors and JavaScript transcompilers.

The section introduces builtin front end stacks used by mdcms.

### SCSS

SCSS represent a variant of Sass. Sass syntax resembles Ruby code, which is elegant and pretty but not compatible with CSS. To address this issue, SCSS syntax becomes a strict superset of CSS intentionally.

### Babel plus Flow

### Images

### Fonts

## Use Your Own Front End Stacks
