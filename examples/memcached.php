<?php

// Providing a Yaml config file to the Factory

require_once __DIR__ . '/../vendor/autoload.php';

use Cache\Factory\Factory;

$cachePoolFactory = new Factory();
$cachePoolFactory->setConfigFile(__DIR__ . '/cache.yml');

$cachePool = $cachePoolFactory->make('memcached');

print_r($cachePool);
