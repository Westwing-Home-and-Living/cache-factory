<?php

use Cache\Factory\Adapter\PHPArray;
use Cache\Factory\Config\Adapter\AdapterInterface as Config;
use Cache\Factory\Config\Loader;

class PHPArrayAdapterTests extends PHPUnit_Framework_TestCase
{
    /**
     * @var string Name of the adapter in the configuration
     */
    protected $adapterName = 'memory';

    /**
     * @var string Type of the cache pool adapter
     */
    protected $adapterType = 'PHPArray';

    /**
     * @var string Path to the config file
     */
    protected $configFile;

    /**
     * @var array
     */
    protected $config;

    /**
     * Sets the config file
     */
    protected function setUp()
    {
        $this->configFile = __DIR__ . '/../cache.yml';

        $configLoader = new Loader();
        $config       = $configLoader->load($this->configFile);

        $configLoader->setAdapterName($this->adapterType);

        $processedConfiguration = $configLoader->process($this->adapterName, $config);
        $this->config           = $processedConfiguration[Config::INDEX_ADAPTER][$this->adapterName];
    }

    /**
     * Tests creation of the filesystem cache item pool
     *
     * @author Damian Gręda <damian.greda@westwing.de>
     */
    public function testMake()
    {
        $filesystemAdapterFactory = new PHPArray();
        $filesystemCacheItemPool  = $filesystemAdapterFactory->make($this->config);

        $this->assertInstanceOf('Psr\\Cache\\CacheItemPoolInterface', $filesystemCacheItemPool);
        $this->assertInstanceOf('\\Cache\\Adapter\\PHPArray\\ArrayCachePool', $filesystemCacheItemPool);
    }
}
