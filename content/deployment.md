# Deploy a mdcms Site with Nginx

## Prologue

## Install Required Packages

### Ubuntu

```shell
$ sudo apt install nginx php php-fpm
```

```shell
$ sudo apt install php-xml php-mbstring
```

```shell
$ sudo apt install nodejs npm
```

### CentOS

```shell
$ sudo dnf install nginx php php-fpm
```

```shell
$ sudo dnf install php-json php-xml php-mbstring
```

```shell
$ sudo dnf install nodejs npm
```

### openSUSE

```shell
$ sudo zypper install nginx php7 php-fpm 
```

```shell
$ sudo zypper install php-phar php-openssl php-mbstring
```

## Set FastCGI Process Manager (FPM)

Listen to socket ...

```
listen = /run/php-fpm/www.sock
```

## Configure Nginx

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
    #  and generate 404.html dynamically.
    #
    #error_page  404              /404.html;

    # In a similiar fashion, you should prepare
    #  a HTTP 50x page as well.
    error_page  500 502 503 504   /50x.html;

    # Route to 50x.html.
    #
    # The page is prerendered by our custom scripts.
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
    #  In this case, php-fpm.
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

    # Include other configurations.
    include vhosts.d/*.conf;
}
```

## Start Related Services

```shell
$ sudo systemctl start php-fpm
```

```shell
$ sudo systemctl start nginx
```

## Set Firewalls

### firewalld

```shell
$ firewall-cmd --permanent --zone=public --add-port=80/tcp
$ firewall-cmd --permanent --zone=public --add-port=443/tcp
```

```shell
$ firewall-cmd --reload
```

### iptables

```shell
$ sudo iptables -A INPUT -p tcp --dport 80 -j ACCEPT
$ sudo iptables -A INPUT -p tcp --dport 443 -j ACCEPT
```

```shell
$ sudo iptables-save > /etc/iptables/rules.v4
```
