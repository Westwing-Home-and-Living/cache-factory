<?php

use Cache\Factory\Config\Adapter\AbstractConfig as Config;
use Cache\Factory\Factory;

class Cache extends Zend_Application_Resource_ResourceAbstract
{
    /**
     * Creates the PSR-6 cache pool based on the application.ini config
     * and sets it in the Zend_Registry
     *
     * @throws Zend_Exception
     */
    public function init()
    {
        /** @var Zend_Config $config */
        $config = Zend_Registry::get('config');

        if (!($config instanceof Zend_Config)) {
            throw new Exception(Factory::EXCEPTION_CONFIG_AND_CONFIG_FILE_NOT_SET);
        }

        try {
            $config = $config->resources->Cache;
        } catch (Exception $e) {
            throw new Exception(Factory::EXCEPTION_CONFIG_AND_CONFIG_FILE_NOT_SET);
        }

        $adapterIndex        = Config::INDEX_ADAPTER;
        $defaultAdapterIndex = Config::INDEX_DEFAULT_ADAPTER;

        /** @var array $config */
        $config = $config->toArray();

        if (empty($config[$adapterIndex]) || !is_array($config[$adapterIndex])) {
            throw new Exception(Factory::EXCEPTION_BAD_CONFIG);
        }

        $defaultAdapter = (!empty($config[$defaultAdapterIndex]) ? $config[$defaultAdapterIndex] : null);

        $cachePoolFactory = new Factory();
        $adaptersConfig   = $config[$adapterIndex];

        foreach ($adaptersConfig as $adapterName => $config) {
            $cachePoolConfig = array(
                Config::INDEX_CACHE => array(
                    $adapterIndex => array(
                        $adapterName => $config
                    )
                )
            );

            $cachePoolFactory->setConfig($cachePoolConfig);

            $cachePool = $cachePoolFactory->makeTaggable($adapterName);

            Zend_Registry::set($adapterName, $cachePool);

            if ($adapterName === $defaultAdapter) {
                Zend_Registry::set($defaultAdapterIndex, $cachePool);
            }
        }
    }
}
