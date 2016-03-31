<?php

use Cache\Factory\Adapter\Filesystem;
use Cache\Factory\Config\Adapter\AdapterInterface as Config;
use Cache\Factory\Config\Loader;

class FilesystemAdapterTests extends PHPUnit_Framework_TestCase
{
    /**
     * @var string Name of the adapter in the configuration
     */
    protected $adapterName = 'local';

    /**
     * @var string Type of the cache pool adapter
     */
    protected $adapterType = 'Filesystem';

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
        $filesystemAdapterFactory = new Filesystem();
        $filesystemCacheItemPool  = $filesystemAdapterFactory->make($this->config);

        $this->assertInstanceOf('Psr\\Cache\\CacheItemPoolInterface', $filesystemCacheItemPool);
        $this->assertInstanceOf('\\Cache\\Adapter\\Filesystem\\FilesystemCachePool', $filesystemCacheItemPool);
    }
}
