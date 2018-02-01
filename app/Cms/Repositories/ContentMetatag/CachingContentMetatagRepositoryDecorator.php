<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:23 PM
 */

namespace App\Cms\Repositories\ContentMetatag;
use App\Cms\Models\ContentMetatag;
use Illuminate\Cache\Repository;
use App\Cms\Repositories\CachingRepositoryDescoratorTrait;

class CachingContentMetatagRepositoryDecorator
    extends AbstractContentMetatagRepositoryDecorator
    implements ContentMetatagRepositoryInterface
{
    use CachingRepositoryDescoratorTrait;

    const TAG_ALL_PUBLIC_CONTENT = 'allPublicMetatag';

    public function __construct(ContentMetatagRepositoryInterface $contentRepository, Repository $cacheRepository)
    {
        parent::__construct($contentRepository);
        $this->cacheRepository = $cacheRepository;
        $this->cache_ttl = env('CACHE_TTL', 60);
    }

    public function findById($id): ContentMetatag
    {
        return parent::findById($id);
    }

    public function save($content): ContentMetatag
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

    public function findByContent($content_id, string $content_model) {
        $key = 'CONTENT_METATAG:';
        $key .= ';'.md5($content_id.':'.$content_model);

        $taggedCache = $this->cacheRepository->tags(self::TAG_ALL_PUBLIC_CONTENT);

        $cachedValue = $this->cacheFunctionResult($taggedCache, $key, $this->getCacheTtl(),
            function() use ($content_id, $content_model) {
            return $this->contentRepository->findByContent($content_id, $content_model);
        });

        return $cachedValue;
    }
}