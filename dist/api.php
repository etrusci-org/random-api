<?php
require __DIR__.'/lib/conf.php';
require __DIR__.'/lib/api.php';

$API = new RandomAPI(
    $dbFile=$conf['dbFile'],
    $validNodes=$conf['validNodes'],
);

$API->processRequest();

$API->output();
