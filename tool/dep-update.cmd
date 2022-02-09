@ECHO OFF

:: Usage:
::
:: $ cd <project_directory>/
:: $ ./dep-update.cmd

curl -o app/public/lib/WebRouter.php       https://raw.githubusercontent.com/etrusci-org/nifty/main/php/class/WebRouter.php
curl -o app/public/lib/DatabaseSQLite3.php https://raw.githubusercontent.com/etrusci-org/nifty/main/php/class/DatabaseSQLite3.php
curl -o app/public/lib/clientIP.php        https://raw.githubusercontent.com/etrusci-org/nifty/main/php/function/clientIP.php
curl -o app/public/lib/jenc.php            https://raw.githubusercontent.com/etrusci-org/nifty/main/php/function/jenc.php
curl -o app/public/lib/jdec.php            https://raw.githubusercontent.com/etrusci-org/nifty/main/php/function/jdec.php
