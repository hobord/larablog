<?php
/**
 * Created by PhpStorm.
 * User: Balazss
 * Date: 2/1/2018
 * Time: 2:23 PM
 */

namespace App\Cms\Repositories\Page;
use Illuminate\Cache\Repository;
use App\Cms\Models\Page;
use App\Cms\Repositories\CachingRepositoryDescoratorTrait;

class CachingPageRepositoryDecorator
    extends AbstractPageRepositoryDecorator
    implements PageRepositoryInterface
{
    use CachingRepositoryDescoratorTrait;

    const TAG_ALL_PUBLIC_CONTENT = 'allPublicPage';

    public function __construct(PageRepositoryInterface $contentRepository, Repository $cacheRepository)
    {
        parent::__construct($contentRepository);
        $this->cacheRepository = $cacheRepository;
        $this->cache_ttl = env('CACHE_TTL', 60);
    }

    public function findById($id): Page
    {
        return parent::findById($id);
    }

    public function save($content): Page
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
        $key = 'ALL_PAGE';
        $key .= ';'.md5($key);

        $taggedCache = $this->cacheRepository->tags(self::TAG_ALL_PUBLIC_CONTENT);

        $cachedValue = $this->cacheFunctionResult($taggedCache, $key, $this->getCacheTtl(), function() {
            return self::findPublic();
        });

        return $cachedValue;
    }

    public function paginatedQuery($args, $fields)
    {
        $keys = [];
        foreach ($args as $key => $val) {
            $keys[] = ",".$key.":".(is_array($val))?implode(",", $val):$val;
        }
        $key = "ARGS:". implode(",", $keys);
        $key .= "FIELDS:". implode(",", array_keys($fields));

        $key .= 'PAGINATED_PAGES:'.md5($key);

        $taggedCache = $this->cacheRepository->tags(self::TAG_ALL_PUBLIC_CONTENT); //TODO

        $cachedValue = $this->cacheFunctionResult($taggedCache, $key, $this->getCacheTtl(),
            function() use ($args, $fields) {
            return parent::paginatedQuery($args, $fields);
        });
        return $cachedValue;
    }
}