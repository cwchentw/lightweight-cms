Welcome to the official site of Lightweight CMS. If you are new to this website publishing software, view our [introductory articles](/#introduction) first.

<!-- Separator. -->
<div style="padding-top: 25pt;"></div>

<h2 id="quick-start">Quick Start</h2>

<p class="quick-start-hint">We think you are using <span id="client-system"></span></p>

<pre class="install-on-windows" style="display: none;"><code class="shell">> choco install php --version=8.1.7
> choco install composer
> choco install nodejs --version=16.15.1
> choco install rsync
> choco install sed
</code></pre>

<pre class="run-on-windows" style="display: none;"><code class="shell">> git clone https://github.com/cwchentw/lightweight-cms.git mysite
> cd mysite
> .\tools\bin\serve.bat
</code></pre>

<pre class="run-on-windows" style="display: none;"><code class="shell">> git remote set-url origin https://example.com/user/mysite.git
> .\tools\bin\migrate.bat
> git add .
> git commit -m "Migrate to a new site"
> git push -u origin master
</code></pre>

<pre class="install-on-macos" style="display: none;"><code class="shell">$ brew install php@8.1
$ brew install composer
$ brew install node@16
</code></pre>

<pre id="run-on-macos" style="display: none;"><code class="shell">$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
$ cd mysite
$ ./tools/bin/serve
</code></pre>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ sudo apt install php php-xml php-mbstring php-zip unzip
</code></pre>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
</code></pre>

<p class="install-on-ubuntu" style="display: none;">Install <a href="https://github.com/nvm-sh/nvm" target="_blank" rel="noopener nofollow"><code>nvm</code></a></p>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ nvm install 16.15.1
$ nvm use 16.15.1
</code></pre>

<pre id="run-on-ubuntu" style="display: none;"><code class="shell">$ git clone https://github.com/cwchentw/lightweight-cms.git mysite
$ cd mysite
$ ./tools/bin/serve
</code></pre>

<pre id="run-on-unix" style="display: none;"><code class="shell">$ git remote set-url origin https://example.com/user/mysite.git
$ ./tools/bin/migrate
$ git add .
$ git commit -m "Migrate to a new site"
$ git push -u origin master
</code></pre>

<p class="quick-start-hint">View the instructions for <button id="instruction-windows" class="btn btn-secondary">Windows</button> <button id="instruction-macos" class="btn btn-secondary">macOS</button> <button id="instruction-linux" class="btn btn-secondary">GNU/Linux</button></p>

<script>
(function () {
    function isWindows () {
        return window.navigator.userAgent.indexOf("Windows") !== -1;
    }

    function isMacOS () {
        return window.navigator.userAgent.indexOf("Mac") !== -1;
    }

    var clientSystem = document.getElementById('client-system');

    var installOnWindows = document.getElementsByClassName("install-on-windows");
    var runOnWindows = document.getElementsByClassName("run-on-windows");

    var installOnMacOS = document.getElementsByClassName("install-on-macos");

    var installOnUbuntu = document.getElementsByClassName("install-on-ubuntu");

    if (isWindows()) {
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "inherit";
        }

        for (var i = 0; i < runOnWindows.length; ++i) {
            runOnWindows[i].style.display = "inherit";
        }

        clientSystem.innerText = "Windows";
    }
    else if (isMacOS()) {
        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "inherit";
        }

        document.getElementById("run-on-macos").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";

        clientSystem.innerText = "macOS";
    }
    else {
        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "inherit";
        }

        document.getElementById("run-on-ubuntu").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";

        clientSystem.innerText = "GNU/Linux";
    }

    document.getElementById("instruction-windows").addEventListener("click", function () {
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "inherit";
        }

        for (var i = 0; i < runOnWindows.length; ++i) {
            runOnWindows[i].style.display = "inherit";
        }

        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "none";
        }

        document.getElementById("run-on-macos").style.display = "none";
        document.getElementById("run-on-unix").style.display = "none";

        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "none";
        }

        document.getElementById("run-on-ubuntu").style.display = "none";
    });

    document.getElementById("instruction-macos").addEventListener("click", function () {
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "none";
        }

        for (var i = 0; i < runOnWindows.length; ++i) {
            runOnWindows[i].style.display = "none";
        }

        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "inherit";
        }

        document.getElementById("run-on-macos").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";

        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "none";
        }

        document.getElementById("run-on-ubuntu").style.display = "none";
    });

    document.getElementById("instruction-linux").addEventListener("click", function () {
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "none";
        }

        for (var i = 0; i < runOnWindows.length; ++i) {
            runOnWindows[i].style.display = "none";
        }

        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "none";
        }

        document.getElementById("run-on-macos").style.display = "none";

        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "inherit";
        }

        document.getElementById("run-on-ubuntu").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";
    });
})();
</script>
