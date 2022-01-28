@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ tool/tsc-watch.cmd
::
:: Config:
SET tsconfigFile="./tsconfig.json"
:: --------------------------------------

tsc --watch -p %tsconfigFile%
