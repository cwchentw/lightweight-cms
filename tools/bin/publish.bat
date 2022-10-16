@echo off
rem Publish a mdmcs site to a PaaS.


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

rem Check whether Composer is available on the system.
call composer --version >nul || (
    echo No Composer on the system >&2
    exit /b 1
)

set address=%1
if "" == "%address%" (
    set address=localhost:5000
)

rem Get working directory of current batch script.
set cwd=%~dp0
rem Get path to executables.
set bin=%cwd%..\bin
rem Get path to library.
set lib=%cwd%..\lib
rem Get path to PHP scripts.
set libexec=%cwd%..\libexec

rem Generate site settings if it doesn't exist.
if not exist %lib%\settings.bat (
    call %bin%\init.bat || (
        exit /b %ERRORLEVEL%
    )
)

rem Load site settings.
call %lib%\settings.bat

rem Download third-party PHP packages if they don't exist.
if not exist %root%\vendor (
    call composer install --no-dev || (
        exit /b %ERRORLEVEL%
    )
)

rem Create a 404.html
call %bin%\404.bat || (
    exit /b %ERRORLEVEL%
)

rem Create a 50x.html
call %bin%\50x.bat || (
    exit /b %ERRORLEVEL%
)

rem Create an offline.html
call %bin%\offline.bat || (
    exit /b %ERRORLEVEL%
)

rem Create a manifest.json
call %bin%\manifest.bat || (
    exit /b %ERRORLEVEL%
)

rem Create a sitemap.xml
call %bin%\sitemap.bat || (
    exit /b %ERRORLEVEL%
)

rem Create a rss.xml
call %bin%\rss.bat || (
    exit /b %ERRORLEVEL%
)

rem Create a tags.json
call %bin%\tags.bat || (
    exit /b %ERRORLEVEL%
)

rem Load theme assets.
call %bin%\assets.bat || (
    exit /b %ERRORLEVEL%
)

rem Load personal assets.
call %bin%\site-assets.bat || (
    exit /b %ERRORLEVEL%
)

rem Copy static files.
xcopy /s /y %static% %public% || (
    echo Unable to copy static files to the public directory >&2
    exit /b 1
)

rem Copy router of mdcms.
copy /y %www%\index.php %public% || (
    echo Unable to copy router of mdmcs to public directory >&2
    exit /b 1
)
