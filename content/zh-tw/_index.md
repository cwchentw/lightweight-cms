---
title: 輕量級 CMS
---

歡迎來到 **Lightweight CMS (輕量級內容管理系統)** 的官方網站。如果你對本網站發佈軟體感到陌生，先觀看我們的[介紹文章](/zh-tw/#introduction)。

<!-- Separator. -->
<div style="padding-top: 25pt;"></div>

<h2 id="quick-start">快速起步</h2>

<p class="quick-start-hint">我們認為你在使用 <span id="client-system"></span></p>

<div class="install-on-windows demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">&gt;</span> choco install php --version=<span class="choco-php-version">8.1.10</span>
<span class="gp">&gt;</span> choco install composer
<span class="gp">&gt;</span> choco install nodejs --version=18.12.1
<span class="gp">&gt;</span> choco install rsync
<span class="gp">&gt;</span> choco install sed
</pre></div>

<div class="run-on-windows demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">&gt;</span> git clone https://github.com/cwchentw/lightweight-cms.git mysite
<span class="gp">&gt;</span> <span class="k">cd</span> mysite
<span class="gp">&gt;</span> git checkout <span class="github-lwcms-branch">master</span>
<span class="gp">&gt;</span> .\tools\bin\serve.bat
</pre></div>

<div class="run-on-windows demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">&gt;</span> git remote set-url origin https://example.com/user/mysite.git
<span class="gp">&gt;</span> .\tools\bin\migrate.bat
<span class="gp">&gt;</span> git add .
<span class="gp">&gt;</span> git commit -m <span class="s2">"Migrate to a new site"</span>
<span class="gp">&gt;</span> git push -u origin <span class="github-lwcms-branch">master</span>
</pre></div>

<div class="install-on-macos demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">$ </span>brew install php@<span class="brew-php-version">8.1</span>
<span class="gp">$ </span>brew install composer
<span class="gp">$ </span>brew install node@18
</pre></div>

<div class="run-on-macos demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">$ </span>git clone https://github.com/cwchentw/lightweight-cms.git mysite
<span class="gp">$ </span><span class="nb">cd</span> mysite
<span class="gp">$ </span>git checkout <span class="github-lwcms-branch">master</span>
<span class="gp">$ </span>./tools/bin/serve
</pre></div>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ sudo apt install php php-xml php-mbstring php-zip unzip
</code></pre>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
</code></pre>

<p class="install-on-ubuntu" style="display: none;">Install <a href="https://github.com/nvm-sh/nvm" target="_blank" rel="noopener nofollow"><code>nvm</code></a></p>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ nvm install 18.12.1
$ nvm use 18.12.1
</code></pre>

<div id="run-on-ubuntu" class="demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">$ </span>git clone https://github.com/cwchentw/lightweight-cms.git mysite
<span class="gp">$ </span><span class="nb">cd</span> mysite
<span class="gp">$ </span>git checkout <span class="github-lwcms-branch">master</span>
<span class="gp">$ </span>./tools/bin/serve
</pre></div>

<div id="run-on-unix" class="demo-highlight nohighlight" style="display: none;"><pre><span></span><span class="gp">$ </span>git remote set-url origin https://example.com/user/mysite.git
<span class="gp">$ </span>./tools/bin/migrate
<span class="gp">$ </span>git add .
<span class="gp">$ </span>git commit -m <span class="s2">"Migrate to a new site"</span>
<span class="gp">$ </span>git push -u origin <span class="github-lwcms-branch">master</span>
</pre></div>

<style id="css-style">pre { line-height: 125%; }
td.linenos .normal { color: inherit; background-color: transparent; padding-left: 5px; padding-right: 5px; }
span.linenos { color: inherit; background-color: transparent; padding-left: 5px; padding-right: 5px; }
td.linenos .special { color: #000000; background-color: #ffffc0; padding-left: 5px; padding-right: 5px; }
span.linenos.special { color: #000000; background-color: #ffffc0; padding-left: 5px; padding-right: 5px; }
.demo-highlight .hll { background-color: #49483e }
.demo-highlight .c { color: #777777; font-style: italic } /* Comment */
.demo-highlight .err { color: #a61717; background-color: #e3d2d2 } /* Error */
.demo-highlight .esc { color: #cccccc } /* Escape */
.demo-highlight .g { color: #cccccc } /* Generic */
.demo-highlight .k { color: #7686bb; font-weight: bold } /* Keyword */
.demo-highlight .l { color: #cccccc } /* Literal */
.demo-highlight .n { color: #cccccc } /* Name */
.demo-highlight .o { color: #cccccc } /* Operator */
.demo-highlight .x { color: #cccccc } /* Other */
.demo-highlight .p { color: #cccccc } /* Punctuation */
.demo-highlight .ch { color: #777777; font-style: italic } /* Comment.Hashbang */
.demo-highlight .cm { color: #777777; font-style: italic } /* Comment.Multiline */
.demo-highlight .cp { color: #777777; font-style: italic } /* Comment.Preproc */
.demo-highlight .cpf { color: #777777; font-style: italic } /* Comment.PreprocFile */
.demo-highlight .c1 { color: #777777; font-style: italic } /* Comment.Single */
.demo-highlight .cs { color: #777777; font-style: italic } /* Comment.Special */
.demo-highlight .gd { color: #cccccc } /* Generic.Deleted */
.demo-highlight .ge { color: #cccccc } /* Generic.Emph */
.demo-highlight .gr { color: #cccccc } /* Generic.Error */
.demo-highlight .gh { color: #cccccc } /* Generic.Heading */
.demo-highlight .gi { color: #cccccc } /* Generic.Inserted */
.demo-highlight .go { color: #cccccc } /* Generic.Output */
.demo-highlight .gp { color: #bc9458 } /* Generic.Prompt */
.demo-highlight .gs { color: #cccccc } /* Generic.Strong */
.demo-highlight .gu { color: #cccccc } /* Generic.Subheading */
.demo-highlight .gt { color: #cccccc } /* Generic.Traceback */
.demo-highlight .kc { color: #7686bb; font-weight: bold } /* Keyword.Constant */
.demo-highlight .kd { color: #7686bb; font-weight: bold } /* Keyword.Declaration */
.demo-highlight .kn { color: #7686bb; font-weight: bold } /* Keyword.Namespace */
.demo-highlight .kp { color: #7686bb; font-weight: bold } /* Keyword.Pseudo */
.demo-highlight .kr { color: #7686bb; font-weight: bold } /* Keyword.Reserved */
.demo-highlight .kt { color: #7686bb; font-weight: bold } /* Keyword.Type */
.demo-highlight .ld { color: #cccccc } /* Literal.Date */
.demo-highlight .m { color: #4FB8CC } /* Literal.Number */
.demo-highlight .s { color: #51cc99 } /* Literal.String */
.demo-highlight .na { color: #cccccc } /* Name.Attribute */
.demo-highlight .nb { color: #cccccc } /* Name.Builtin */
.demo-highlight .nc { color: #cccccc } /* Name.Class */
.demo-highlight .no { color: #cccccc } /* Name.Constant */
.demo-highlight .nd { color: #cccccc } /* Name.Decorator */
.demo-highlight .ni { color: #cccccc } /* Name.Entity */
.demo-highlight .ne { color: #cccccc } /* Name.Exception */
.demo-highlight .nf { color: #6a6aff } /* Name.Function */
.demo-highlight .nl { color: #cccccc } /* Name.Label */
.demo-highlight .nn { color: #cccccc } /* Name.Namespace */
.demo-highlight .nx { color: #e2828e } /* Name.Other */
.demo-highlight .py { color: #cccccc } /* Name.Property */
.demo-highlight .nt { color: #cccccc } /* Name.Tag */
.demo-highlight .nv { color: #7AB4DB; font-weight: bold } /* Name.Variable */
.demo-highlight .ow { color: #cccccc } /* Operator.Word */
.demo-highlight .pm { color: #cccccc } /* Punctuation.Marker */
.demo-highlight .w { color: #bbbbbb } /* Text.Whitespace */
.demo-highlight .mb { color: #4FB8CC } /* Literal.Number.Bin */
.demo-highlight .mf { color: #4FB8CC } /* Literal.Number.Float */
.demo-highlight .mh { color: #4FB8CC } /* Literal.Number.Hex */
.demo-highlight .mi { color: #4FB8CC } /* Literal.Number.Integer */
.demo-highlight .mo { color: #4FB8CC } /* Literal.Number.Oct */
.demo-highlight .sa { color: #51cc99 } /* Literal.String.Affix */
.demo-highlight .sb { color: #51cc99 } /* Literal.String.Backtick */
.demo-highlight .sc { color: #51cc99 } /* Literal.String.Char */
.demo-highlight .dl { color: #51cc99 } /* Literal.String.Delimiter */
.demo-highlight .sd { color: #51cc99 } /* Literal.String.Doc */
.demo-highlight .s2 { color: #51cc99 } /* Literal.String.Double */
.demo-highlight .se { color: #51cc99 } /* Literal.String.Escape */
.demo-highlight .sh { color: #51cc99 } /* Literal.String.Heredoc */
.demo-highlight .si { color: #51cc99 } /* Literal.String.Interpol */
.demo-highlight .sx { color: #51cc99 } /* Literal.String.Other */
.demo-highlight .sr { color: #51cc99 } /* Literal.String.Regex */
.demo-highlight .s1 { color: #51cc99 } /* Literal.String.Single */
.demo-highlight .ss { color: #51cc99 } /* Literal.String.Symbol */
.demo-highlight .bp { color: #cccccc } /* Name.Builtin.Pseudo */
.demo-highlight .fm { color: #6a6aff } /* Name.Function.Magic */
.demo-highlight .vc { color: #7AB4DB; font-weight: bold } /* Name.Variable.Class */
.demo-highlight .vg { color: #BE646C; font-weight: bold } /* Name.Variable.Global */
.demo-highlight .vi { color: #7AB4DB; font-weight: bold } /* Name.Variable.Instance */
.demo-highlight .vm { color: #7AB4DB; font-weight: bold } /* Name.Variable.Magic */
.demo-highlight .il { color: #4FB8CC } /* Literal.Number.Integer.Long */</style>

<div class="quick-start-hint row row-cols-auto justify-content-center">
    <div class="col">
        觀看
    </div>
    <div class="col">
        <select id="platform" class="form-select" aria-label="Select OS">
            <option value="windows" selected>Windows</option>
            <option value="macos">macOS</option>
            <option value="ubuntu">Ubuntu</option>
        </select>
    </div>
    <div class="col">
        的指引。選擇 PHP 版本
    </div>
    <div class="col">
        <select id="php-version" class="form-select" aria-label="Select PHP Version">
            <option value="php81" selected>8.1</option>
            <option value="php80">8.0</option>
        </select>
    </div>
</div>

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
    var runOnMacOS = document.getElementsByClassName("run-on-macos");

    var installOnUbuntu = document.getElementsByClassName("install-on-ubuntu");

    var platformSelection = document.getElementById("platform");

    var chocoPHPVersions = document.getElementsByClassName("choco-php-version");

    var brewPHPVersions = document.getElementsByClassName("brew-php-version");

    var githubCMSBranches = document.getElementsByClassName("github-lwcms-branch");

    if (isWindows()) {
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "inherit";
        }

        for (var i = 0; i < runOnWindows.length; ++i) {
            runOnWindows[i].style.display = "inherit";
        }

        clientSystem.innerText = "Windows";

        platformSelection.getElementsByTagName("option")[0].selected = "selected";
    }
    else if (isMacOS()) {
        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "inherit";
        }

        for (var i = 0; i < runOnMacOS.length; ++i) {
            runOnMacOS[i].style.display = "inherit";
        }

        document.getElementById("run-on-unix").style.display = "inherit";

        clientSystem.innerText = "macOS";

        platformSelection.getElementsByTagName("option")[1].selected = "selected";
    }
    else {
        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "inherit";
        }

        document.getElementById("run-on-ubuntu").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";

        clientSystem.innerText = "GNU/Linux";

        platformSelection.getElementsByTagName("option")[2].selected = "selected";
    }

    document.getElementById("platform").addEventListener("change", function (e) {
        var platform = e.target.value;
        if ("windows" === platform) {
            for (var i = 0; i < installOnWindows.length; ++i) {
                installOnWindows[i].style.display = "inherit";
            }

            for (var i = 0; i < runOnWindows.length; ++i) {
                runOnWindows[i].style.display = "inherit";
            }

            for (var i = 0; i < installOnMacOS.length; ++i) {
                installOnMacOS[i].style.display = "none";
            }

            for (var i = 0; i < runOnMacOS.length; ++i) {
                runOnMacOS[i].style.display = "none";
            }

            document.getElementById("run-on-unix").style.display = "none";

            for (var i = 0; i < installOnUbuntu.length; ++i) {
                installOnUbuntu[i].style.display = "none";
            }

            document.getElementById("run-on-ubuntu").style.display = "none";
        }
        else if ("macos" === platform) {
            for (var i = 0; i < installOnWindows.length; ++i) {
                installOnWindows[i].style.display = "none";
            }

            for (var i = 0; i < runOnWindows.length; ++i) {
                runOnWindows[i].style.display = "none";
            }

            for (var i = 0; i < installOnMacOS.length; ++i) {
                installOnMacOS[i].style.display = "inherit";
            }

            for (var i = 0; i < runOnMacOS.length; ++i) {
                runOnMacOS[i].style.display = "inherit";
            }

            document.getElementById("run-on-unix").style.display = "inherit";

            for (var i = 0; i < installOnUbuntu.length; ++i) {
                installOnUbuntu[i].style.display = "none";
            }

            document.getElementById("run-on-ubuntu").style.display = "none";
        }
        else {
            for (var i = 0; i < installOnWindows.length; ++i) {
                installOnWindows[i].style.display = "none";
            }

            for (var i = 0; i < runOnWindows.length; ++i) {
                runOnWindows[i].style.display = "none";
            }

            for (var i = 0; i < installOnMacOS.length; ++i) {
                installOnMacOS[i].style.display = "none";
            }

            for (var i = 0; i < runOnMacOS.length; ++i) {
                runOnMacOS[i].style.display = "none";
            }

            for (var i = 0; i < installOnUbuntu.length; ++i) {
                installOnUbuntu[i].style.display = "inherit";
            }

            document.getElementById("run-on-ubuntu").style.display = "inherit";
            document.getElementById("run-on-unix").style.display = "inherit";
        }
    });

    document.getElementById("php-version").addEventListener("change", function (e) {
        var phpVersion = e.target.value;

        if ("php81" === phpVersion) {
            console.log("PHP 8.1 is selected");
            console.log(chocoPHPVersions.length);
            for (var i = 0; i < chocoPHPVersions.length; ++i) {
                chocoPHPVersions[i].innerText = "8.1.10";
            }

            for (var i = 0; i < brewPHPVersions.length; ++i) {
                brewPHPVersions[i].innerText = "8.1";
            }

            for (var i = 0; i < githubCMSBranches.length; ++i) {
                githubCMSBranches[i].innerText = "master";
            }
        }
        else if ("php80" === phpVersion) {
            console.log("PHP 8.0 is selected");
            for (var i = 0; i < chocoPHPVersions.length; ++i) {
                console.log("Select PHP 8.0 on Windows");
                chocoPHPVersions[i].innerText = "8.0.22";
            }

            for (var i = 0; i < brewPHPVersions.length; ++i) {
                brewPHPVersions[i].innerText = "8.0";
            }

            console.log(githubCMSBranches.length);
            for (var i = 0; i < githubCMSBranches.length; ++i) {
                githubCMSBranches[i].innerText = "php80";
            }
        }
    });
})();
</script>
