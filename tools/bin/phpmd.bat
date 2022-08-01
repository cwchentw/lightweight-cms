@echo off
rem Lint PHP scripts with PHPMD


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

rem Check whether a valid target.
set target=%1
if not exist "%target%" (
    echo No valid target >&2
    exit /b 1
)

rem Get working directory of current batch script.
set cwd=%~dp0
rem Get the root path.
set root=%cwd%..
rem Get path to executables.
set bin=%root%\bin
rem Get path to library.
set lib=%root%\lib
rem Get path to config.
set etc=%root%\etc

rem Generate site settings if it doesn't exist.
if not exist %lib%\settings.bat (
    call %bin%\init.bat || (
        exit /b %ERRORLEVEL%
    )
)

rem Load site settings.
call %lib%\settings.bat

"%root%\vendor\bin\phpmd.bat" "%target%" text "%etc%\phpmd.xml" 
