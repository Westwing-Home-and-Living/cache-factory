<?php

const CACHE_KEY   = 'test_key';
const CACHE_VALUE = 'test_value';

// Providing a Yaml config file to the Factory

require_once __DIR__ . '/../vendor/autoload.php';

use Cache\Factory\Factory;

$cachePoolFactory = new Factory();
$cachePoolFactory->setConfigFile(__DIR__ . '/cache.yml');

$cachePool = $cachePoolFactory->make('memcached');

$cachePool->getItem(CACHE_KEY)->set(CACHE_VALUE);

if ($cachePool->hasItem(CACHE_KEY)) {
    echo sprintf(
        "Yay! Item '%s' found in cache: '%s'",
        CACHE_KEY,
        $cachePool->getItem(CACHE_KEY)
    );
} else {
    echo sprintf(
        "Oops! Item '%s' NOT found in cache!",
        CACHE_KEY
    );
}
