@ECHO OFF

:: Usage:
::
:: cd random-api/
:: ./dev/database-create.cmd

SET sqlite3Bin="./dev/sqlite3.exe"
SET dbFile="./dist/data/db.sqlite3"
SET initFile="./dev/database/init.txt"

%sqlite3Bin% %dbFile% ".read %initFile%"
