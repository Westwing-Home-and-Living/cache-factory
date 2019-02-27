<?php

use Cache\Factory\Adapter\PHPArray;
use Cache\Factory\Config\Adapter\PHPArray as Config;

class PHPArrayAdapterTests extends BaseAdapterTests
{
    /**
     * @var string Name of the adapter in the configuration
     */
    protected $adapterName = 'memory';

    /**
     * @var string Type of the cache pool adapter
     */
    protected $adapterType = 'PHPArray';

    /* @var Cache\Adapter\PHPArray\ArrayCachePool */
    protected $arrayCacheItemPool;

    public function setUp()
    {
        parent::setUp();

        $arrayAdapterFactory = new PHPArray();
        $this->arrayCacheItemPool  = $arrayAdapterFactory->make($this->config);
    }

    /**
     * Tests creation of the filesystem cache item pool
     */
    public function testMake()
    {
        $this->assertInstanceOf('Psr\\Cache\\CacheItemPoolInterface', $this->arrayCacheItemPool);
        $this->assertInstanceOf('\\Cache\\Adapter\\PHPArray\\ArrayCachePool', $this->arrayCacheItemPool);
    }

    /**
     *  Test cache limit setting
     */
    public function testConfigurationOfLimit()
    {
        // We are creating as many items as limit says
        $limit = $this->config[Config::INDEX_LIMIT];
        if ($limit === null) {
            $this->markTestSkipped('Limit is not set in configuration');
        }
        for ($i = 1; $i <= $limit; $i++) {
            $this->arrayCacheItemPool->set('variable' . $i, 'value');
        }

        // We are checking if first item exist - it should
        $this->assertTrue($this->arrayCacheItemPool->hasItem('variable1'));

        // We add one more item
        $this->arrayCacheItemPool->set('variable' . $i, 'value');

        // We are checking if first item exist - it should not
        $this->assertFalse($this->arrayCacheItemPool->hasItem('variable1'));
    }

    /**
     * Test if variables from provided array exists in cache
     */
    public function testConfigurationOfInitialArray()
    {
        $initialCacheArray = $this->config[Config::INDEX_CACHE_ARRAY];
        if (empty($initialCacheArray)) {
            $this->markTestSkipped('Initial cache array is not set in configuration');
        }
        foreach ($initialCacheArray as $key => $value) {
            $this->assertEquals($this->arrayCacheItemPool->getItem($key)->get(), $value);
        }
    }
}
