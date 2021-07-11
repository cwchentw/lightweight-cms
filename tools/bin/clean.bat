@echo off
rem Clean downloaded code.


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

rem Create a public directory if it doesn't exist.
if not exist %public% (
    mkdir %public% || (
        echo Unable to create a public directory >&2
        exit /b 1
    )
)

for %%D in (vendor node_modules public %theme%\vendor %theme%\node_modules %theme%\public) do rmdir /s /q %%D
