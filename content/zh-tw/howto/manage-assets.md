---
title: 如何處理靜態資產
linkTitle: 處理靜態資產
mtime: 2021/6/26
weight: 1
---

## 前言

In web programming, assets compose of which are placed in front end such as CSS sheets, JavaScript scripts, fonts, images and audios. This article discusses asset management is Lightweight CMS sites.

## 佈景主題資產和站台資產

There are two levels of assets in Lightweight CMS sites. Theme assets mean those used by Lightweight CMS themes while site assets used by Lightweight CMS sites.

Theme assets are managed by theme creators. You should keep them *as is* unless you want to create or modify a theme. In this place we discuss site assets.

## 將靜態資產放在 *static* 目錄

If your asset doesn't require processing or compiling before sending to front end, keep it in *static* directory. Those kept in *static* directory will be copied the same way to client environments.

## 將靜態資產放在 *assets* 目錄

Many front end languages are invented to improve original front end technologies. They are HTML template languages, CSS preprocessors and JavaScript transcompilers.

The section introduces builtin front end stacks used by Lightweight CMS.

### SCSS

SCSS represent a variant of Sass. Original Sass syntax intentionally resembles Ruby code, which is elegant and pretty but not compatible with CSS. To address this issue, SCSS syntax becomes a strict superset of CSS.

SCSS sheets are stored in *assets/sass*.

### Babel 加上 Flow

ECMAScript 6+ introduces many convenient features to improve code quality of JavaScript. However, they are unrecognized and unusable on older browsers. Babel transcompiles ES6+ code to corresponding ES5 one for browser compatibility.

Original Babel keeps the same type system of Javascript. Flow enhances Babel code by adding type checking.

Babel scripts are stored in *assets/js*.

### 圖片

Images are mininized to save bandwidth. They are stored in *assets/img*.

### 字型

Fonts are copied *as is*. We keeps them in *asset* directory just for easier management. They are stored in *assets/font*.

## 監控靜態資產及熱更新

This feature is supported through Gulp [watch()](https://gulpjs.com/docs/en/api/watch/).

## 設置將移除目錄和檔案

*Experimental*

Themes may bring their front stacks in addition to those used by Lightweight CMS sites. Therefore, you should not delete all assets under *public* while processing or compiling assets. Instead, you should set a list of directories and files to delete during asset building.

Currently, you have to edit such lists in *build* scripts. We may change it later.

## 使用自已喜好的前端技術

If you are not satisfied with builtin front end stacks, you may introduce your own. Nevertheless, you require to write your own build scripts to manage assets.
