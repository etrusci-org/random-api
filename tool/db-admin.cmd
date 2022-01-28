@ECHO OFF

:: --------------------------------------
:: Usage:
:: $ cd random-api/
:: $ tool/db-admin.cmd
::
:: Config:
SET sqlite3Bin="./tool/sqlite3.exe"
SET dbFile="./app/protected/data/db.sqlite3"
:: --------------------------------------

%sqlite3Bin% %dbFile%
