<?php
/**
 * Created by PhpStorm.
 * User: tm-rm
 * Date: 11.03.16
 * Time: 09:24
 */

require_once __DIR__ . '/vendor/autoload.php';

$finder = new WCKZ\DateUtil\DateFinder();
$finder->add(function($line, $i) {
    $line = substr($line, 7);
    $line = substr($line, 0, 10);

    return $line;
});

$finder->find('Datum: 10.02.1998');

var_dump($finder->getDates());