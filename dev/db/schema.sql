-- Schema for SQLite3 database.

BEGIN TRANSACTION;


-- Use for logging access and applying rate limiting.
CREATE TABLE IF NOT EXISTS sys_accesslog (
    id            INTEGER  PRIMARY KEY AUTOINCREMENT,
    accessTime    REAL     NOT NULL,
    clientHash    TEXT     NOT NULL,
    apiRequest    TEXT     NOT NULL
);

-- Data source for entity names.
DROP TABLE IF EXISTS data_names;
CREATE TABLE data_names (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Data source for prime numbers.
DROP TABLE IF EXISTS data_primes;
CREATE TABLE data_primes (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  INTEGER  NOT NULL UNIQUE
);

-- Data source for pseudo hashes of length 16.
DROP TABLE IF EXISTS data_pseudohash16;
CREATE TABLE data_pseudohash16 (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Data source for pseudo hashes of length 32.
DROP TABLE IF EXISTS data_pseudohash32;
CREATE TABLE data_pseudohash32 (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Data source for pseudo hashes of length 64.
DROP TABLE IF EXISTS data_pseudohash64;
CREATE TABLE data_pseudohash64 (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);



COMMIT;
