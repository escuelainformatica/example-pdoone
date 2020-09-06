<?php

use eftec\PdoOne;

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/Collection.php'; // to show an html table
include __DIR__.'/dBug.php'; // to "var_dump" our values.

$pdoOne=new PdoOne('mysql','127.0.0.1','root','abc.123','example-pdo');
$pdoOne->open();
$pdoOne->logLevel=3; // it shows all errors with arguments.

