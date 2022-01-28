@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ tool/csso_watch.cmd
::
:: Config:
SET inputFile="./src/res/theme1.css"
SET outputFile="./app/public/res/theme1.min.css"
:: --------------------------------------

csso ^
    --watch ^
    --stat ^
    --comments none ^
    --input-source-map auto ^
    --source-map file ^
    --input %inputFile% ^
    --output %outputFile%
