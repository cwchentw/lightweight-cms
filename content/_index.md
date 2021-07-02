Welcome to official site of mdcms (Markdown Content Management System). If you are new to mdcms, view our articles first.

*mdcms is still experimental.*

<!-- Separator. -->
<div style="padding-top: 25pt;"></div>

<pre class="install-on-windows" style="display: none;"><code class="shell">> choco install php --version=7.4.20
> choco install composer
> choco install nodejs
> choco install python2
</code></pre>

<p class="install-on-windows" style="display: none;">Install Visual C++ from <a href="https://aka.ms/vs/15/release/vs_buildtools.exe">Build Tools for Visual Studio 2017</a></p>

<pre id="run-on-windows" style="display: none;"><code class="shell">> git clone https://github.com/cwchentw/mdcms.git mysite
> cd mysite
> .\tools\bin\serve.bat
</code></pre>

<pre class="install-on-macos" style="display: none;"><code class="shell">$ brew install php@7.4
$ brew install composer
$ brew install node
</code></pre>

<pre id="run-on-macos" style="display: none;"><code class="shell">$ git clone https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/serve
</code></pre>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ sudo apt install php php-xml php-mbstring php-zip
$ sudo apt install build-essential
</code></pre>

<p class="install-on-ubuntu" style="display: none;">Install <a href="https://github.com/nvm-sh/nvm"><code>nvm</code></a></p>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ nvm install node
</code></pre>

<pre id="run-on-ubuntu" style="display: none;"><code class="shell">$ git clone https://github.com/cwchentw/mdcms.git mysite
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
        var installOnWindows = document.getElementsByClassName("install-on-windows");
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "inherit";
        }

        document.getElementById("run-on-windows").style.display = "inherit";
    }
    else if (isMacOS()) {
        var installOnMacOS = document.getElementsByClassName("install-on-macos");
        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "inherit";
        }

        document.getElementById("run-on-macos").style.display = "inherit";
    }
    else {
        var installOnUbuntu = document.getElementsByClassName("install-on-ubuntu");
        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "inherit";
        }

        document.getElementById("run-on-ubuntu").style.display = "inherit";
    }
})();
</script>
