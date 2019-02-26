<?php

namespace Cache\Factory\Adapter;

class PHPArray extends AbstractAdapter
{
    const ADAPTER_NAMESPACE_TEMPLATE = '\\Cache\\Adapter\\%s\\ArrayCachePool';

    /**
     * @inheritdoc
     */
    protected function getConfiguredDriver(array $config)
    {
        return new \Cache\Adapter\PHPArray\ArrayCachePool();
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
