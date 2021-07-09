@echo off
rem Sync the local repo to a production environment.
rem  Unrequired directories and files are skipped.


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

rem Check whether rsync is available on the system.
rsync --version >nul || (
    echo No rsync on the system >&2
    exit /b 1
)

set dest=%1
if "" == "%dest%" (
    echo No destination >&2
    exit /b 1
)

if not exist %dest% (
    echo Invalid destination: %dest% >&2
    exit /b 1
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

rem Create a 404.html
call %bin%\404.bat || (
    exit /b %ERRORLEVEL%
)

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
call %bin%\site-assets.bat || (
    exit /b %ERRORLEVEL%
)

rem Copy static files.
xcopy /s /y %static% %public% || (
    echo Unable to copy static files to the public directory >&2
    exit /b 1
)

rem Remove router of mdcms.
del /q %public%\index.php

rem Trick for rsync on Windows.
set source=%root:C:\=\cygdrive\c\%\
set target=%dest:C:\=\cygdrive\c\%
set source=%source:\=/%
set target=%target:\=/%

rem Sync directories and files between the source
rem  and the destination.
rem
rem Directories and files on the destination may be deleted.
rem  Don't edit them on production environments.
rsync -rvh --delete ^
    --exclude ".git*" ^
    --exclude tools --exclude assets --exclude build --exclude static ^
    --exclude composer.json --exclude composer.lock ^
    --exclude LICENSE --exclude README.md --exclude TODO.md ^
    --exclude package.json --exclude package-lock.json --exclude node_modules ^
    --exclude .browserlistrc --exclude .stylelintrc ^
    --exclude .eslintrc --exclude .flowconfig ^
    %source% %target%
