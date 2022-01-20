<?php
$conf = array(
    'dbFile' => '../protected/data/db.sqlite3',

    'validNodes' => array(
        'names',
        'primes',
    ),

    'debugApi' => FALSE,

    'rateLimiting' => array(
        'requestDelay' => 2.0, # {float}, seconds
        'maxRequestsPerDay' => 50, # {int}
    ),
);
