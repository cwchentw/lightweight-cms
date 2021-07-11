@echo off
rem Trim trailing spaces with Perl.


rem Check whether Perl is available on the system.
perl --version 2>&1 1>nul || (
    set ret=%errorlevel%
    echo No Perl on the system >&2
    exit /b %ret%
)

rem Iterate over all files in the repo, trimming trailing spaces.
for %%E in ("md", "html", "scss", "js", "php") do ^
forfiles /s /m *.%%E ^
/C "cmd /c echo @path | findstr "node_modules" || ( perl -i -ple \"s{\s+$}{};\" @path)"
