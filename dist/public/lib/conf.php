<?php
error_reporting(0);

define('API_VERSION', '1.0.0');

$conf = array(
    // Whether to output in plain text with additional info.
    'debugApi' => FALSE,

    // Path to db file. On init realpath() will be applied.
    'dbFile' => __DIR__.'/../../protected/data/db.sqlite3',

    // Valid API route nodes.
    'validNodes' => array(
        'names', # table: data_names
        'primes', # table: data_primes
        'pseudohashes16', # table: data_pseudohashes16
        'pseudohashes32', # table: data_pseudohashes32
        'pseudohashes64', # table: data_pseudohashes64
        'triangulars', # table: data_triangulars
    ),

    // Limit access rates.
    'rateLimiting' => array(
        'intervalMaximum' => array('requests' => 100, 'interval' => 3600),
        'requestDelay' => 1,
    ),
);
