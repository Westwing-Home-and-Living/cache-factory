<?php

use Cache\Factory\Config\Adapter\AdapterInterface as Config;
use Cache\Factory\Config\Loader;

abstract class BaseAdapterTests extends PHPUnit_Framework_TestCase
{
    /**
     * @var string Name of the adapter in the configuration
     */
    protected $adapterName;

    /**
     * @var string Type of the cache pool adapter
     */
    protected $adapterType;

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
        if (!isset($this->adapterName)) {
            throw new Exception(
                sprintf('Provide $adapterName in %s', (new ReflectionClass($this))->getFileName())
            );
        } elseif (!isset($this->adapterType)) {
            throw new Exception(
                sprintf('Provide $adapterType in %s', (new ReflectionClass($this))->getFileName())
            );
        }

        $this->configFile = __DIR__ . '/../cache.yml';

        $configLoader = new Loader();
        $config       = $configLoader->load($this->configFile);

        $configLoader->setAdapterName($this->adapterType);

        $processedConfiguration = $configLoader->process($this->adapterName, $config);
        $this->config           = $processedConfiguration[Config::INDEX_ADAPTER][$this->adapterName];
    }

    /**
     * Tests creation of the filesystem cache item pool
     */
    abstract public function testMake();
}
