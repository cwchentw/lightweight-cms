# About mdcms

[mdcms (Markdown Content Management System)](https://github.com/cwchentw/mdcms) represents a Markdown-based dynamic website generator powered by PHP.

Unlike static website generators, the HTML pages in mdcms-based websites are rendered dynamically, just like all PHP-powered sites. Nonetheless, the sites in mdcms doesn't rely on any relational database for content storage. Instead, contents in such sites are stored as flat Markdown files (or HTML pages).

Our approach combines the advantages of two worlds. Website owners can create contents in a simple and lightweight markup language instead of betting on some custom online editor. Flat text files are easier to backup and recover than database dumps.

With the advent of CDN services like Cloudflare, it takes virtually no effort to cache contents, no matter they are static or dynamic. Static sites are no longer important in this issue. In addition, they are of limited uses for several types of websites, such as a membership website or a mix of a blog and web application.

The website itself is a live demonstration of mdcms, powered by a classical combination of GNU/Linux, Nginx and PHP.
