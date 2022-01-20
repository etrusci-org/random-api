@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ dev/db-create.cmd
::
:: Config:
SET sqlite3Bin="./dev/sqlite3.exe"
SET dbFile="./dist/protected/data/db.sqlite3"
SET initFile="./dev/db/init.txt"
:: --------------------------------------

%sqlite3Bin% %dbFile% ".read %initFile%"
