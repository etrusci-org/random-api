<?php
$conf = array(
    // Whether to output in plain text with additional info.
    'debugApi' => FALSE,

    // Absolute path to db file. On init realpath() will be applied.
    'dbFile' => __DIR__.'/../../protected/data/db.sqlite3',

    // Valid API route nodes.
    'validNodes' => array(
        'names', # table: data_names
        'primes', # table: data_primes
        'pseudohash16', # table: data_pseudohash16
        'pseudohash32', # table: data_pseudohash32
        'pseudohash64', # table: data_pseudohash64
        'triangulars', # table: data_triangulars
    ),

    // Limit requests.
    'rateLimiting' => array(
        'requestDelay' => 1.0, # {float}, seconds
        'maxRequestsPerDay' => 600, # {int}
        'maxRequestsPerMinute' => 10, # {int}
    ),
);
