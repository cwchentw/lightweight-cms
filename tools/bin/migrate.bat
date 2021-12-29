@echo off
rem Migrate local mdcms repository to a new site


rem Check whether PHP is available on the system.
php --version >nul || (
    echo No PHP on the system >&2
    exit /b 1
)

rem Check whether sed is available on the system.
sed --version >nul || (
    echo No sed on the system >&2
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

copy "%root%\config\information.template.php" "%root%\config\information.php" || (
    echo Unable to copy information.php >&2
    exit /b 1
)

copy "%root%\config\socialMedia.template.php" "%root%\config\socialMedia.php" || (
    echo Unable to copy socialMedia.php >&2
    exit /b 1
)

copy "%root%\config\parameters.template.php" "%root%\config\parameters.php" || (
    echo Unable to copy parameters.php >&2
    exit /b 1
)

copy "%root%\config\optionalFeatures.template.php" "%root%\config\optionalFeatures.php" || (
    echo Unable to copy optionalFeatures.php >&2
    exit /b 1
)

copy "%root%\config\sortCallbacks.template.php" "%root%\config\sortCallbacks.php" || (
    echo Unable to copy sortCallbacks.php >&2
    exit /b 1
)

copy "%root%\config\internal.template.php" "%root%\config\internal.php" || (
    echo Unable to copy internal.php >&2
    exit /b 1
)

set informationConfig=%root%\config\information.php
sed -i "s/mdcms.org/example.com/" %informationConfig:\=/% || (
    echo Unable to modify information.php >&2
    exit /b 1
)

set socialMediaConfig=%root%\config\socialMedia.php
sed -i "s/cwchentw\/mdcms//" %socialMediaConfig:\=/% || (
    echo Unable to modify socialMedia.php >&2
    echo /b 1
)

set parametersConfig=%root%\config\parameters.php
sed -i "6 { N; N; N; N; N; N; N; N; s/define(.*""REDIRECT_LIST"",.*);/define(""REDIRECT_LIST"", []);/; }" %parametersConfig:\=/% || (
    echo Unable to modify parameters.php >&2
    echo /b 1
)

sed -i "s/#578583//" %parametersConfig:\=/% || (
    echo Unable to modify parameters.php >&2
    echo /b 1
)

set optionalFeaturesConfig=%root%\config\optionalFeatures.php
sed -i "s/UA-105146581-5//" %optionalFeaturesConfig:\=/% || (
    echo Unable to modify optionalFeatures.php >&2
    echo /b 1
)

set internalConfig=%root%\config\internal.php
sed -i "s/content/posts/" "%internalConfig:\=/%" || (
    echo Unable to modify internal.php >&2
    exit /b 1
)

mkdir "%root%\posts" || (
    echo Unable to create post directory >&2
    exit /b 1
)

"%bin%\touch.bat" "%root%\posts\.gitkeep" || (
    echo Unable to create .gitkeep >&2
    exit /b 1
)

rem Regenerate site settings because project structure
rem  of local repository is changed.
call %bin%\init.bat || (
    exit /b %ERRORLEVEL%
)
