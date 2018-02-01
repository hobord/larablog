<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:23 PM
 */

namespace App\Cms\Repositories\Content;
use Illuminate\Cache\Repository;
use App\Cms\Models\Content;
use App\Cms\Repositories\CachingRepositoryDescoratorTrait;

class CachingContentRepositoryDecorator
    extends AbstractContentRepositoryDecorator
    implements ContentRepositoryInterface
{
    use CachingRepositoryDescoratorTrait;

    const TAG_ALL_PUBLIC_CONTENT = 'allPublicContent';

    public function __construct(ContentRepositoryInterface $contentRepository, Repository $cacheRepository)
    {
        parent::__construct($contentRepository);
        $this->cacheRepository = $cacheRepository;
        $this->cache_ttl = env('CACHE_TTL', 60);
    }

    public function findById($id): Content
    {
        return parent::findById($id);
    }

    public function save($content): Content
    {
        $result = parent::save($content);

        $this->cacheRepository->tags([
            self::TAG_ALL_PUBLIC_CONTENT
        ])->flush();

        return $result;
    }

    public function deleteById($id)
    {
        parent::deleteById($id);

        $this->cacheRepository->tags([
            self::TAG_ALL_PUBLIC_CONTENT
        ])->flush();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findPublic()
    {

        $key = 'ALL_CONTENT';
        $key .= ';'.md5($key);

        $taggedCache = $this->cacheRepository->tags(self::TAG_ALL_PUBLIC_CONTENT);

        $cachedValue = $this->cacheFunctionResult($taggedCache, $key, $this->getCacheTtl(), function(){
            return $this->contentRepository->findPublic();
        });

        return $cachedValue;
    }
}