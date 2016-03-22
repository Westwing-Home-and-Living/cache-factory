<?php

use Cache\Factory\Config\Adapter\AdapterInterface as Config;
use Cache\Factory\Config\Adapter\Filesystem;
use Cache\Factory\Factory;

class FactoryTests extends PHPUnit_Framework_TestCase
{
    protected $adapterName = 'local';

    protected $adapterType = 'Filesystem';

    /**
     * Returns a valid configuration with a single cache adapter using Filesystem
     *
     * @return array
     */
    protected function getValidSingleAdapterConfig()
    {
        return array(
            Config::INDEX_CACHE => array(
                Config::INDEX_ADAPTER => array(
                    $this->adapterName => array(
                        Config::INDEX_TYPE     => $this->adapterType,
                        Filesystem::INDEX_PATH => __DIR__,
                    )
                )
            )
        );
    }

    /**
     * Tests that the factory can create a proper PSR-6 compatible Cache Pool based on valid configuration
     */
    public function testFactoryWithConfigAndSingleFilesystemAdapter()
    {
        $cachePoolFactory = new Factory();

        $cachePoolFactory->setConfig($this->getValidSingleAdapterConfig());

        $cachePool = $cachePoolFactory->make($this->adapterName);

        $this->assertInstanceOf('Psr\\Cache\\CacheItemPoolInterface', $cachePool);
    }
}