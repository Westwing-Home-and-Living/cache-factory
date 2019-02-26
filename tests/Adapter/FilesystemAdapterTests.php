<?php

use Cache\Factory\Adapter\Filesystem;

class FilesystemAdapterTests extends BaseAdapterTests
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
