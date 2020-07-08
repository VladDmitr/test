<?php

declare(strict_types=1);

use Psr\Cache\CacheItemPoolInterface;

class DataManagerCacheDecorator implements DataManagerInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var DataManagerInterface
     */
    private $dataManager;

    private const CACHE_DATE_PLUS = '+1 day';

    public function __construct(CacheItemPoolInterface $cache, DataManagerInterface $dataManager)
    {
        $this->cache = $cache;
        $this->dataManager = $dataManager;
    }

    public function get(array $params): array
    {
        $cachedItem = $this->cache->getItem($this->getCacheKey($params));
        if ($cachedItem->isHit()) {
            $result = $cachedItem->get();
        } else {
            $result = $this->dataManager->get($params);
            $cachedItem
                ->set($result)
                ->expiresAt((new DateTime())->modify(self::CACHE_DATE_PLUS));
            $this->cache->save($cachedItem);
        }

        return $result;
    }

    private function getCacheKey(array $params): string
    {
        return md5(json_encode($params));
    }
}