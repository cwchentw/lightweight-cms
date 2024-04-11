@echo off
rem wtouch.bat - Simulate Unix `touch` on Windows.
rem Copyright (c) 2020 ByteBard.
rem Licensed under MIT.


rem Limit the scopes of the variables in this script.
setlocal

set dest=%1

if "%dest%" == "" (
    echo No target path >&2
    exit /B 1
)

if exist "%dest%" (
    dir /B "%dest%" 1>nul 2>&1
    exit /B %ERRORLEVEL%
)

rem Trick to supress newline on Command Prompt.
echo|set /P= > "%dest%"
exit /B %ERRORLEVEL%
