@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ dev/tsc-watch.cmd
::
:: Config:
SET tsconfigFile="./tsconfig.json"
:: --------------------------------------

tsc --watch -p %tsconfigFile%
