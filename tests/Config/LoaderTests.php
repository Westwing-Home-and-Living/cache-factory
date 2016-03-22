<?php

use Cache\Factory\Config\Adapter\AbstractConfig as Config;
use Cache\Factory\Config\Loader;

class LoaderTests extends PHPUnit_Framework_TestCase
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
     * Sets the config file
     */
    protected function setUp()
    {
        $this->configFile = __DIR__ . '/../cache.yml';
    }

    /**
     * Performs set of assertions to verify that config is correct.
     *
     * @param array $config The configuration to perform assertions on
     */
    protected function assertCorrectConfig(array $config)
    {
        $this->assertArrayHasKey(Config::INDEX_CACHE, $config);
        $this->assertArrayHasKey(Config::INDEX_ADAPTER, $config[Config::INDEX_CACHE]);
        $this->assertArrayHasKey($this->adapterName, $config[Config::INDEX_CACHE][Config::INDEX_ADAPTER]);
        $this->assertArrayHasKey(
            Config::INDEX_TYPE,
            $config[Config::INDEX_CACHE][Config::INDEX_ADAPTER][$this->adapterName]
        );
        $this->assertContains(
            $this->adapterType,
            $config[Config::INDEX_CACHE][Config::INDEX_ADAPTER][$this->adapterName][Config::INDEX_TYPE]
        );
    }

    /**
     * Tests that the loader returns the correct array when loading the provided config file
     * and that it is able to process it successfully.
     */
    public function testThatLoaderCanLoadFileAndProcessConfigCorrectly()
    {
        $loader = new Loader();
        $config = $loader->load($this->configFile);

        $loader->setAdapterName($this->adapterType);

        $this->assertArrayHasKey(Config::INDEX_CACHE, $config);
        $this->assertArrayHasKey(Config::INDEX_ADAPTER, $config[Config::INDEX_CACHE]);
        $this->assertArrayHasKey($this->adapterName, $config[Config::INDEX_CACHE][Config::INDEX_ADAPTER]);
        $this->assertArrayHasKey(
            Config::INDEX_TYPE,
            $config[Config::INDEX_CACHE][Config::INDEX_ADAPTER][$this->adapterName]
        );
        $this->assertContains(
            $this->adapterType,
            $config[Config::INDEX_CACHE][Config::INDEX_ADAPTER][$this->adapterName][Config::INDEX_TYPE]
        );

        $processedConfig = $loader->process($this->adapterName, $config);

        $this->assertArrayHasKey(Config::INDEX_ADAPTER, $processedConfig);
        $this->assertArrayHasKey($this->adapterName, $processedConfig[Config::INDEX_ADAPTER]);
        $this->assertArrayHasKey(
            Config::INDEX_TYPE,
            $processedConfig[Config::INDEX_ADAPTER][$this->adapterName]
        );
        $this->assertContains(
            $this->adapterType,
            $processedConfig[Config::INDEX_ADAPTER][$this->adapterName][Config::INDEX_TYPE]
        );
    }
}
