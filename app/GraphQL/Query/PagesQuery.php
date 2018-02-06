<?php

namespace App\GraphQL\Query;

use App\Cms\Models\Page;
use App\Cms\Repositories\CachingRepositoryDescoratorTrait;
use App\Cms\Repositories\Page\CachingPageRepositoryDecorator;
use App\Cms\Repositories\Page\EloquentPageRepository;
use App\GraphQL\Type\PaginationType;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Cache\Repository as CacheRepository;
use \Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\Cache;

class PagesQuery extends Query
{
    use CachingRepositoryDescoratorTrait;

    protected $attributes = [
        'name' => 'PagesQuery',
        'description' => 'A query for pages'
    ];


    public function type()
    {
//        return Type::listOf(GraphQL::type('PageType'));
        return new PaginationType('PageType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::ID()],
            'categories_id' => ['name' => 'categories_id', 'type' => Type::listOf(Type::ID())], // And where
            'tags_id' => ['name' => 'tags_id', 'type' => Type::listOf(Type::ID())], // Where in
            'title' => ['name' => 'title', 'type' => Type::string()], // Like search
            'editor' => ['name' => 'editor', 'type' => Type::string()],
            'limit' => ['name' => 'limit', 'type' => Type::int()],
            'page' => ['name' => 'page', 'type' => Type::int()],
            'order_by' => ['name' => 'order_by', 'type' => Type::string()],
            'order_asc' => ['name' => 'order_asc', 'type' => Type::boolean()],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     * @return mixed
     */
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $cacheManager = Cache::getFacadeRoot();
        $cacheRepository = $cacheManager->store();
        $eloquentPageRepository = new EloquentPageRepository(new Page());
        $cachedPageRepository = new CachingPageRepositoryDecorator($eloquentPageRepository, $cacheRepository);

        $fields = $info->getFieldSelection();

        return $cachedPageRepository->paginatedQuery($args, $fields);

//        $cacheRepository = Cache::getFacadeRoot();
//        $this->setCacheTtl(env('CACHE_TTL', 0));
//
//        $fields = $info->getFieldSelection();
//
//        $query = Page::query();
//
//        foreach ($fields as $field => $keys) {
//            if ($field === 'metatags') {
//                $query->with('metatags');
//            }
//        }
//
//        $where = function ($query) use ($args) {
//            if (isset($args['id'])) {
//                $query->where('id',$args['id']);
//            }
//            if (isset($args['title'])) {
//                $query->where('title', 'like', '%' . $args['title'] . '%');
//            }
//        };
//
//        $order_by = (array_key_exists('order_by', $args)) ? $args['order_by'] : 'id';
//        $order_asc = (array_key_exists('order_asc', $args)) ? $args['order_asc'] : false;
//
//        $limit = (array_key_exists('limit', $args)) ? $args['limit'] : 15;
//        $page = (array_key_exists('page', $args)) ? $args['page'] : 0;
//
//        $query = $query->where($where)
//            ->orderBy($order_by, ($order_asc)?'asc':'desc');
//
//        $taggedCache = $cacheRepository->tags("PAGINATED_PAGES"); //todo
//        $key = "key"; //todo
//
//        $cachedValue = $this->cacheFunctionResult($taggedCache, $key, $this->getCacheTtl(),
//            function() use ($query, $limit, $page) {
//            return $query->paginate($limit, ['*'], 'page', $page);
//        });
//
//        return $cachedValue;
    }
}
