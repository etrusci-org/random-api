@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ dev/db-admin.cmd
::
:: Config:
SET sqlite3Bin="./dev/sqlite3.exe"
SET dbFile="./dist/protected/data/db.sqlite3"
:: --------------------------------------

%sqlite3Bin% %dbFile%
