@echo off
rem Check whether the posts are modified.


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

rem Generate site settings if it doesn't exist.
if not exist %lib%\settings.bat (
    call %bin%\init.bat || (
        exit /b %ERRORLEVEL%
    )
)

rem Load site settings.
call %lib%\settings.bat

rem No public directory. Don't create the checksum file.
if not exist %public% (
    exit /b 0
)

rem Create the checksum file.
php %libexec%\checkFile.php || (
    echo Unable to create checked.json >&2
    exit /b 1
)
