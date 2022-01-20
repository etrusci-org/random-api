<?php
require __DIR__.'/lib/conf.php';
require __DIR__.'/lib/api.php';


$API = new RandomAPI($conf);

$API->output();
