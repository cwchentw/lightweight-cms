@echo off
rem A utility script to re-generate the main translation file of a Lightweight CMS site.


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
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

rem Re-generate the main translation file.
php %libexec%\trans.php || (
    echo Unable to create the main translation file >&2
    exit /b 1
)
