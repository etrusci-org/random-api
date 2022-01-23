@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd musicaddict2/
:: $ dev/bin/csso_watch.cmd
::
:: Config:
SET inputFile="./src/res/theme1.css"
SET outputFile="./dist/public/res/theme1.min.css"
:: --------------------------------------

csso ^
    --watch ^
    --stat ^
    --comments none ^
    --input-source-map auto ^
    --source-map file ^
    --input %inputFile% ^
    --output %outputFile%
