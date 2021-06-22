@echo off
rem A utility script to generate a manifest.json for mdcms.


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

rem Get working directory of current batch script.
set cwd=%~dp0
rem Get root path of mdcms
set root=%cwd%..\..
rem Get library path.
set libexec=%cwd%..\libexec
rem Get public path.
set public=%root%\public

rem Create a public directory if it doesn't exist.
if not exist %public% (
    mkdir %public% || (
        echo Unable to create a public directory >&2
        exit /b 1
    )
)

rem Create a manifest.json.
php %libexec%\manifest.php > %public%\manifest.json || (
    echo Unable to create a manifest.json >&2
    exit /b 1
)
