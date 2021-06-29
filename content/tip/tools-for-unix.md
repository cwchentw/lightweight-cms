---
title: Tips to Tools for Unix
mtime: 2021/6/30
---

## Synopsis

Pending.

## How to Run mdcms Sites Locally without Apache or Nginx

```shell
$ ./tools/bin/serve
```

```shell
$ ./tools/bin/serve localhost:3000
```

```shell
$ sudo ./tools/bin/serve
```

## How to Synchonize Content to a Production Environment

```shell
$ ./tools/bin/sync-to path/to/www
```

```shell
$ sudo ./tools/bin/sync-to /path/to/www
```

## How to Update Site Settings after Changing Project Structure

```shell
$ ./tools/bin/init
```
