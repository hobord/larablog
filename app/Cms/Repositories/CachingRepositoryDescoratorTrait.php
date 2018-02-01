<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 3:18 PM
 */

namespace App\Cms\Repositories;

use Illuminate\Cache\Repository;

trait CachingRepositoryDescoratorTrait
{
    private $cacheRepository;
    private $cache_ttl;

    /**
     * @param Repository $storage
     * @param $cacheKey
     * @param $ttl
     * @param callable $callabele
     * @return mixed
     */
    private function cacheFunctionResult(Repository $storage, $cacheKey, $ttl, callable $callabele)
    {
        $cachedValue = $storage->get($cacheKey);
        if(is_null($cachedValue)) {
            $cachedValue = $callabele();
            $storage->put($cacheKey, $cachedValue, $ttl);
        }

        return $cachedValue;
    }

    public function getCacheTtl()
    {
        return $this->cache_ttl;
    }

    public function setCacheTtl($cache_ttl)
    {
        $this->cache_ttl = $cache_ttl;
    }
}