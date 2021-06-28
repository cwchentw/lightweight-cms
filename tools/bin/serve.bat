@echo off
rem Run a mdcms site locally with builtin web server of PHP.


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

set address=%1
if "" == "%address%" (
    set address=localhost:5000
)

rem Get working directory of current batch script.
set cwd=%~dp0
rem Get root path of mdcms
set root=%cwd%..\..
rem Get application path.
set www=%root%\www
rem Get public path.
set public=%root%\public
rem Get static directory
set static=%root%\static
rem Get bin directory
set bin=%cwd%

rem Create a 50x.html
call %bin%\50x.bat || (
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

rem Load theme assets.
call %bin%\assets.bat || (
    exit /b %ERRORLEVEL%
)

rem Load personal assets.
call %bin%\siteAssets.bat || (
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

rem Run a mdcms site locally.
echo Run a mdcms site locally. Press ctrl + c to stop the server.
php -S %address% -t %public%
