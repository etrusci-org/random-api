@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ tool/db-create.cmd
::
:: Config:
SET sqlite3Bin="./tool/sqlite3.exe"
SET dbFile="./app/protected/data/db.sqlite3"
SET initFile="./src/db/init.txt"
:: --------------------------------------

%sqlite3Bin% %dbFile% ".read %initFile%"
