Welcome to official site of mdcms (Markdown Content Management System). If you are new to mdcms, view our articles first.

*mdcms is still experimental.*

<pre id="install-on-windows" style="display: none;"><code class="shell">> choco install php --version=7.4.20
> choco install composer
> choco install nodejs
</code></pre>

<pre id="run-on-windows" style="display: none;"><code class="shell">> git clone https://github.com/cwchentw/mdcms.git mysite
> cd mysite
> .\tools\bin\serve.bat
</code></pre>

<pre id="install-on-macos" style="display: none;"><code class="shell">$ brew install php@7.4
$ brew install composer
$ brew install node
</code></pre>

<pre id="run-on-macos" style="display: none;"><code class="shell">$ git clont https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/serve
</code></pre>

<pre id="install-on-ubuntu" style="display: none;"><code class="shell">$ sudo apt install php php-xml php-mbstring php-zip
$ nvm install node
</code></pre>

<pre id="run-on-ubuntu" style="display: none;"><code class="shell">$ git clont https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/install-composer $HOME/bin
$ ./tools/bin/serve
</code></pre>

<script>
(function () {
    function isWindows () {
        return window.navigator.userAgent.indexOf("Windows") !== -1;
    }

    function isMacOS () {
        return window.navigator.userAgent.indexOf("Mac") !== -1;
    }

    if (isWindows()) {
        document.getElementById("install-on-windows").style.display = "inherit";
        document.getElementById("run-on-windows").style.display = "inherit";
    }
    else if (isMacOS()) {
        document.getElementById("install-on-macos").style.display = "inherit";
        document.getElementById("run-on-macos").style.display = "inherit";
    }
    else {
        document.getElementById("install-on-ubuntu").style.display = "inherit";
        document.getElementById("run-on-ubuntu").style.display = "inherit";
    }
})();
</script>