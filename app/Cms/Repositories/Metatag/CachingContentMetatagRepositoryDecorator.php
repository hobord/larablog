<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:23 PM
 */

namespace App\Cms\Repositories\Metatag;
use App\Cms\Models\Metatag;
use Illuminate\Cache\Repository;
use App\Cms\Repositories\CachingRepositoryDescoratorTrait;

class CachingMetatagRepositoryDecorator
    extends AbstractMetatagRepositoryDecorator
    implements MetatagRepositoryInterface
{
    use CachingRepositoryDescoratorTrait;

    const TAG_ALL_METATAGS = 'allMetatag';

    public function __construct(MetatagRepositoryInterface $contentRepository, Repository $cacheRepository)
    {
        parent::__construct($contentRepository);
        $this->cacheRepository = $cacheRepository;
        $this->cache_ttl = env('CACHE_TTL', 60);
    }

    public function findById($id): Metatag
    {
        return parent::findById($id);
    }

    public function save($content): Metatag
    {
        $result = parent::save($content);

        $this->cacheRepository->tags([
            self::TAG_ALL_METATAGS
        ])->flush();

        return $result;
    }

    public function deleteById($id)
    {
        parent::deleteById($id);

        $this->cacheRepository->tags([
            self::TAG_ALL_METATAGS
        ])->flush();
    }

    public function listAll() {
        $key = 'METATAGS:';
        $key .= ';'.md5($key);

        $taggedCache = $this->cacheRepository->tags(self::TAG_ALL_METATAGS);

        $cachedValue = $this->cacheFunctionResult($taggedCache, $key, $this->getCacheTtl(),
            function() {
            return parent::listAll();
        });

        return $cachedValue;
    }
}