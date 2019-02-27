<?php

namespace Cache\Factory\Adapter;

use Cache\Factory\Config\Adapter\PHPArray as Config;

class PHPArray extends AbstractAdapter
{
    const ADAPTER_NAMESPACE_TEMPLATE = '\\Cache\\Adapter\\%s\\ArrayCachePool';

    protected $cachePoolClassName;

    /**
     * @inheritdoc
     */
    public function make(array $config)
    {
        $this->cachePoolClassName = $this->getAdapterClassName(static::class);
        $cacheDriver              = $this->getConfiguredDriver($config);

        return $cacheDriver;
    }

    /**
     * @inheritdoc
     */
    protected function getConfiguredDriver(array $config)
    {
        $cacheLimit        = $config[Config::INDEX_LIMIT];
        $cacheInitialArray = $config[Config::INDEX_CACHE_ARRAY];

        foreach ($cacheInitialArray as $key => $value) {
            $cacheInitialArray[$key] = [
                0 => $value,
                1 => [],
                2 => null
            ];
        }

        return new $this->cachePoolClassName($cacheLimit, $cacheInitialArray);
    }

    /**
     * @inheritdoc
     */
    protected function getAdapterClassName($adapterClassName)
    {
        $adapterClassName = str_replace(__NAMESPACE__, '', $adapterClassName);
        $adapterClassName = str_replace('\\', '', $adapterClassName);
        $adapterClassName = sprintf(self::ADAPTER_NAMESPACE_TEMPLATE, $adapterClassName);

        return $adapterClassName;
    }
}
