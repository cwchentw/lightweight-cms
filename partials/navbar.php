<?php
require_once __DIR__ . "/../setting.php";
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/"><?php echo SITE_SHORT_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarSiteInfo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Info
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarSiteInfo">
            <li><a class="dropdown-item" href="/about/">About the Site</a></li>
            <li><a class="dropdown-item" href="#">Terms and Conditions (Pending)</a></li>
            <li><a class="dropdown-item" href="#">Privacy Policy (Pending)</a></li>
          </ul>
        </li>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarMedia" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Media
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarMedia">
            <li><a class="dropdown-item" href="#">Facebook Fans Page (Pending)</a></li>
            <li><a class="dropdown-item" href="#">Facebook Group (Pending)</a></li>
            <li><a class="dropdown-item" href="#">Twitter (Pending)</a></li>
            <li><a class="dropdown-item" href="https://github.com/cwchentw/mdcms" target="_blank">GitHub</a></li>
          </ul>
        </li>
            </ul>
        </div>
    </div>
</nav>