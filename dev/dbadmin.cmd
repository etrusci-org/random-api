@ECHO OFF

:: Usage:
::
:: cd random-api/
:: ./dev/dbadmin.cmd

SET sqlite3Bin="./dev/sqlite3.exe"
SET dbFile="./dist/data/db.sqlite3"

%sqlite3Bin% %dbFile%
