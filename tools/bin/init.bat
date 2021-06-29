@echo off
rem Initialize site settings dynamically on Windows.


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

rem Get working directory of current batch script.
set cwd=%~dp0
rem Get path of library.
set lib=%cwd%..\lib
rem Get path of PHP scripts.
set libexec=%cwd%..\libexec

php %libexec%\initForWin.php > %lib%\settings.bat || (
    echo Unable to generate site settings >&2
    exit 1
)
