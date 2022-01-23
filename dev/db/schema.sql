-- Schema for SQLite3 database.

BEGIN TRANSACTION;


-- Use for logging access and applying rate limiting.
CREATE TABLE IF NOT EXISTS sys_accesslog (
    id            INTEGER  PRIMARY KEY AUTOINCREMENT,
    accessTime    INTEGER  NOT NULL,
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
DROP TABLE IF EXISTS data_pseudohashes16;
CREATE TABLE data_pseudohashes16 (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Data source for pseudo hashes of length 32.
DROP TABLE IF EXISTS data_pseudohashes32;
CREATE TABLE data_pseudohashes32 (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Data source for pseudo hashes of length 64.
DROP TABLE IF EXISTS data_pseudohashes64;
CREATE TABLE data_pseudohashes64 (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  TEXT     NOT NULL UNIQUE
);

-- Data source for triangulars.
DROP TABLE IF EXISTS data_triangulars;
CREATE TABLE data_triangulars (
    id   INTEGER  PRIMARY KEY AUTOINCREMENT,
    val  INTEGER  NOT NULL UNIQUE
);


COMMIT;
