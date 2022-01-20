-- Schema for SQLite3 database.

BEGIN TRANSACTION;


-- Table sys_access
-- Use for logging access and applying rate limiting.
CREATE TABLE IF NOT EXISTS sys_accesslog (
    id            INTEGER  PRIMARY KEY AUTOINCREMENT,
    accessTime    REAL     NOT NULL,
    clientHash    TEXT     NOT NULL,
    apiRequest    TEXT     NOT NULL
);

-- Table data_names
-- Data source for entity names.
CREATE TABLE IF NOT EXISTS data_names (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Table data_names
-- Data source for prime numbers.
CREATE TABLE IF NOT EXISTS data_primes (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  INTEGER  NOT NULL UNIQUE
);


COMMIT;
