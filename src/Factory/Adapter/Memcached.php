<?php

namespace Cache\Factory\Adapter;

use Cache\Factory\Config\Adapter\Memcached as Config;

class Memcached extends AbstractAdapter
{
    protected function getConfiguredDriver(array $config)
    {
        $memcached = new \Memcached();
        
        $memcached->addServer(
            $config[Config::INDEX_HOST],
            $config[Config::INDEX_PORT]
        );

        return $memcached;
    }
}