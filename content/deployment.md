---
title: Deploy a mdcms Site to Nginx
mtime: 2021/6/19
weight: 4
---

## Prologue

This article demonstrates the whole process to deploy a mdcms site to a Nginx web server on GNU/Linux.

## Install Required Packages

### Ubuntu

Invoke this command to install a mininal Nginx and PHP combination:

```shell
$ sudo apt install nginx php php-fpm
```

Invoke this command to install packages for Composer:

```shell
$ sudo apt install php-xml php-mbstring
```

If you utilize *default* theme of mdcms, invoke this command as well:

```shell
$ sudo apt install nodejs npm
```

### CentOS

Run the following command to install a Nginx and PHP combo:

```shell
$ sudo dnf install nginx php php-fpm
```

Run this command to install packages for Composer:

```shell
$ sudo dnf install php-json php-xml php-mbstring
```

Run this command as well if you utilize *default* theme of mdcms:

```shell
$ sudo dnf install nodejs npm
```

### openSUSE

Run this command for a bare Nginx and PHP based solution:

```shell
$ sudo zypper install nginx php7 php7-fpm 
```

Run the command to install packages for Composer:

```shell
$ sudo zypper install php7-phar php7-openssl php7-mbstring
```

Run the command if you use *default* theme of mdcms:

```shell
$ sudo zypper install nodejs14 npm14
```

## Set a PHP Pool of FastCGI Process Manager

Your package of FastCGI Process Manager (FPM) should set a default PHP pool on installation. Don't modify these configurations unless you know what you do. A wrongly configured FPM may result in a defunct service.

Check `listen` field of configuration of system PHP pool. You will see something like this:

```
listen = /run/php-fpm/www.sock
```

This is what you will set in your Nginx configuration.

On openSUSE, no active configuration is ready by default. Simply copy default configurations provided by php-fpm package from openSUSE:

```shell
$ sudo cp /etc/php7/fpm/php-fpm.conf.default /etc/php7/fpm/php-fpm.conf
$ sudo cp /etc/php7/fpm/php-fpm.d/www.conf.default /etc/php7/fpm/php-fpm.d/www.conf
```

## Configure Nginx

Here we list a heavily-commented Nginx sample configuration:

```nginx
# A sample Nginx configuration for mdcms-based sites.
#
# Don't simply copy and paste the configuration here. Instead,
#  modify it according to your own situations.


server {
    # The port of your server.
    listen       3000;

    # The domain name of your server.
    server_name  localhost;

    # If your Nginx serves a HTTPS site,
    #  SSL related configuration are mandatory.
    #
    # You may get a free SSL certificate at
    #   Let's Encrypt (https://letsencrypt.org/).
    #
    #ssl_certificate     /path/to/site.crt;
    #ssl_certificate_key /path/to/site.key;
    #ssl_protocols       TLSv1 TLSv1.1 TLSv1.2;
    #ssl_ciphers         HIGH:!aNULL:!MD5;

    # Route to assets.
    #
    # You may require to set various expiration times
    #  for different assets. If the case, set
    #  separate assets in distinct `location` blocks.
    #
    location ~ \.(css|js|json|xml|jpg|jpeg|png|gif|woff|woff2)$ {
        root  /var/www/mdcms/public/;
    }

    # You should always prepare a HTTP 404 page
    #  to hide sensitive system information.
    #
    # We redirect all URLs to our index script
    #  and generate a 404.html dynamically.
    #
    #error_page  404              /404.html;

    # In a similiar fashion, you should prepare
    #  a HTTP 50x page as well.
    error_page  500 502 503 504   /50x.html;

    # Route to 50x.html.
    #
    # The page is prerendered by our custom script.
    #  Therefore, it is static.
    #
    location /50x.html {
        root  /var/www/mdcms/public/;
    }

    # Route to all URLs except assets.
    location / {
        root  /var/www/mdcms/www/;

        # Try local files first. If none is matched,
        #  rewrite the URL to our index script.
        try_files $uri $uri.php $uri.html $uri.htm @rewrite;
    }

    # Redirect all URLs to our index script.
    #
    # Currently, we don't handle URL parameters at all.
    #
    location @rewrite {
        rewrite ^(.+)$ /index.php;
    }

    # Pass PHP scripts to a FastCGI server.
    location ~ \.php$ {
        root           /var/www/mdcms/www/;

        # Listen to a local server.
        #fastcgi_pass   127.0.0.1:9000;
        # Listen to a socket.
        fastcgi_pass   unix:/run/php-fpm/www.sock;

        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;

        include        fastcgi_params;
    }
}
```

## Start Related Services

Assume your configurations are ready. Start system FPM service:

```shell
$ sudo systemctl start php-fpm
```

In a similar fashion, start a Nginx web server:

```shell
$ sudo systemctl start nginx
```

If any of your configuration is wrong, these services will fail to start. Trace those error messages and debug it accordingly.

## Set Firewalls

You have to open ports for web service to accept external network connections. Default port for HTTP is 80 while that for HTTPs is 443.

### firewalld

Invoke the following commands to open related ports:

```shell
$ firewall-cmd --permanent --zone=public --add-port=80/tcp
$ firewall-cmd --permanent --zone=public --add-port=443/tcp
```

Reload firewalld to make your changes effective:

```shell
$ firewall-cmd --reload
```

### iptables

Invoke the following commands to open related ports:

```shell
$ sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
$ sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT
```

Save current iptables rules persistently:

```shell
$ sudo iptables-save > /etc/iptables/rules.v4
```
