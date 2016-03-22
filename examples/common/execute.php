<?php

$cacheItem = $cachePool->getItem(CACHE_KEY)->set(CACHE_VALUE)->expiresAfter(CACHE_TTL);
$cachePool->save($cacheItem);

if ($cachePool->hasItem(CACHE_KEY)) {
    echo sprintf(
        "Yay! Item '%s' found in cache: '%s'%s",
        CACHE_KEY,
        $cachePool->getItem(CACHE_KEY)->get(),
        PHP_EOL
    );
} else {
    echo sprintf(
        "Oops! Item '%s' NOT found in cache!%s",
        CACHE_KEY,
        PHP_EOL
    );
}
