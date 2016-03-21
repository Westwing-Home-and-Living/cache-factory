<?php

namespace Cache\Factory\Adapter;

use Cache\Factory\Config\Adapter\Predis as Config;
use Predis\Client;

class Predis extends AbstractAdapter
{
    protected function getConfiguredDriver(array $config)
    {
        $client = new Client(
            $config[Config::INDEX_SERVERS],
            $config[Config::INDEX_OPTIONS]
        );

        return $client;
    }
}