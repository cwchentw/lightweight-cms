# Architectural Notice: Build-Time Heuristic Code and Security Boundaries

This repository is part of a series of theme boilerplates designed for LightweightCMS acting as a Static Site Generator (SSG). To facilitate rapid prototyping and advanced dynamic rendering during the local build phase, certain components leverage an explicit `eval()` execution pattern.

## 1. Context & Rationale

When used strictly as an SSG, the system requires a mechanism to execute arbitrary, helper-level PHP scripts embedded inside local content files (e.g., directory indexing, complex local taxonomy aggregation). 

This heuristic code block provides the missing flexibility for theme developers to manipulate build-time data without introducing a heavy plugin framework.

## 2. Affected Components

You will find the following pattern repeated across our theme boilerplates (typically within rendering templates or routers):

```php
try {
    eval(\$post[LIGHTWEIGHT_CMS_POST_CONTENT]);
    http_response_code(200);
}
// ... error handling
```

## 3. Strict Security Boundaries

As an open-source project, we must emphasize that `eval()` introduces serious Remote Code Execution (RCE) vulnerabilities if misplaced. However, this implementation is deemed safe **ONLY under the following operational assumptions**:

* **Trusted Source Material:** The content variable (`LIGHTWEIGHT_CMS_POST_CONTENT`) must be completely derived from static, local files (such as Markdown or local text files) managed via version control (Git).
* **No User-Generated Content (UGC):** This system is **NOT** designed to accept public form inputs, comments, or external API payloads into the content pipeline.
* **No Production Database Links:** This pattern must never be connected to a database that can be modified by unauthorized web traffic.

## 4. Production Warning for Forking / Extending

If you plan to fork this boilerplate or adapt its codebase for a standard **dynamic CMS** (where clients or anonymous users can log in, edit posts, or save content to a database), **YOU MUST REMOVE THE `eval()` BLOCK IMMEDIATELY.** 

Failure to do so will expose your server to full system compromise. Consider replacing this block with a safe, restricted Domain-Specific Language (DSL) like Shortcodes or BBCode parsers.
