<?php

use Cache\Factory\Adapter\PHPArray;

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

    /**
     * Tests creation of the filesystem cache item pool
     */
    public function testMake()
    {
        $filesystemAdapterFactory = new PHPArray();
        $filesystemCacheItemPool  = $filesystemAdapterFactory->make($this->config);

        $this->assertInstanceOf('Psr\\Cache\\CacheItemPoolInterface', $filesystemCacheItemPool);
        $this->assertInstanceOf('\\Cache\\Adapter\\PHPArray\\ArrayCachePool', $filesystemCacheItemPool);
    }
}
