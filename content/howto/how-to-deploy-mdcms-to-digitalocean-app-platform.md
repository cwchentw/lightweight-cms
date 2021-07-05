---
title: Deploy a mdcms Site to DigitalOcean App Platform
mtime: 2021/7/5
---

## Prologue

Some web programmers prefer [PaaS](https://en.wikipedia.org/wiki/Platform_as_a_service) over [VPS](https://en.wikipedia.org/wiki/Virtual_private_server) to delegate server maintenances to a (trustworthy) vendor. This article takes DigitalOcean App Platform as an instance to illustrate the process to deploy a mdcms site to a PaaS.

## System Requirements

* A [DigitalOcean account](https://m.do.co/c/bb01e632c755)
* Git

If you want to try local deployment before putting your mdcms site online, check our [previous article](/basic-usage/).

## Prepare a mdcms Site

Clone mdcms locally and rename it:

```shell
$ git clone https://github.com/cwchentw/mdcms.git mysite
```

Change your working directory to root path of the cloned repo:

```shell
$ cd mysite
```

Save the repo to a remote Git repository (either [GitHub](https://github.com/) or [GitLab](https://gitlab.com/)):

```shell
$ git remote set-url origin https://example.com/user/mysite.git
$ git push -u origin master
```

This step is mandatory because DigitalOcean App Platform will fetch code of your mdcms site from a remote repo.

## Run Your Site Locally First

Before deploying a site to a PaaS, you should always try your code locally. Here are steps to run your mdcms site locally:

```shell
$ ./tools/bin/publish
$ cd public
$ php -S localhost:3000
```

`tools/bin/publish` is our utility script to deploy a mdcms site to a PaaS. The script will copy router of mdcms and assets to *public* directory. It resembles `tools/bin/serve` but the former won't call builtin server of PHP automatically.

## Initial Deployment

On initial deployment, a PaaS will fetch your code from a remote repository, trying to build and deploy your website or web application. The article takes DigitalOcean App Platform as an example to demonstrate the process.

Choose your source:

<p><img src="/img/howto/digitalocean-app-platform-choose-source.png" alt="Choose your source for DigitalOcean App Platform" class="img-fluid" /></p>

If you are confident to your commits, check "**Autodeploy code changes**", which will build and deploy your commits automatically.

Configure your application:

<p><img src="/img/howto/digitalocean-app-platform-configure-your-app.png" alt="Configure your application for DigitalOcean App Platform" class="img-fluid" /></p>

Choose *Web Services* here for external sites. DigitalOcean App Platform provides other types of app for internal uses.

Set your *Build Command* like this:

```
tools/bin/publish
```

This is same command we tried locally.

Set your *Run Command* as it:

```
heroku-php-nginx -C tools/etc/nginx_do.conf public/
```

We write a Nginx configuration for this vendor. In addition, you need to specify application path.

Name your web service:

<p><img src="/img/howto/digitalocean-app-platform-name-your-web-service.png" alt="Name your web service for DigitalOcean App Platform" class="img-fluid" /></p>

You should choose a region near your audience here, not yourself.

Choose your plan:

<p><img src="/img/howto/digitalocean-app-platform-finalize-and-launch.png" alt="Choose your plan for DigitalOcean App Platform" class="img-fluid" /></p>

Here we chose *Basic* because we just wanted to try out the platform.

It will take a while to build and deploy your mdcms site:

<p><img src="/img/howto/digitalocean-app-platform-deployed-successfully.png" alt="Deploy your app successfully on DigitalOcean App Platform" class="img-fluid" /></p>

## Subsequent Deployments

Once your mdcms site is set, you don't bother to maintain a web server, which is the reason some programmers choose a PaaS over a VPS. Update your site by committing your changes or triggering a deployment manually.

## Set Custom Domain for Your Site

Even if you are satisfied with your PaaS now, you should always set a custom domain. For any reason, you may need to migrate your mdcms site or other web projects to another host in the future. Here we simulate to set a custom domain on the platform:

<p><img src="/img/howto/digitalocean-app-platform-add-domain.png" alt="Set custom domain for your site on DigitalOcean App Platform" class="img-fluid" /></p>

In this case, set your DNS providers as following:

* `ns1.digitalocean.com`
* `ns2.digitalocean.com`
* `ns3.digitalocean.com`

## Note for PaaS Beginners

Using PaaS instead of VPS is not as easy as you think. You may encounter several failed deployments before first successful one. Read manuals of your PaaS vendor to figure out the tricky parts and possible workarounds.
