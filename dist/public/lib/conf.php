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
    ),

    // Limit requests.
    'rateLimiting' => array(
        'requestDelay' => 2.0, # {float}, seconds
        'maxRequestsPerDay' => 300, # {int}
    ),
);
