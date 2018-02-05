<?php

namespace App\GraphQL\Query;

use App\Cms\Models\Page;
use App\Cms\Repositories\Page\CachingPageRepositoryDecorator;
use App\Cms\Repositories\Page\EloquentPageRepository;
use App\GraphQL\Type\PaginationType;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\Cache;

class PageQuery extends Query
{
    protected $attributes = [
        'name' => 'PagesQuery',
        'description' => 'A query for one page'
    ];


    public function type()
    {
        return GraphQL::type('PageType');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::ID()],
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
//        $pageRepository = new EloquentPageRepository(new Page());
//        $cacheRepository = Cache::getFacadeRoot();
//        $cachingPageRepository = new CachingPageRepositoryDecorator($pageRepository, $cacheRepository);
//        if (isset($args['id'])) {
//            $page = $cachingPageRepository->findById($args['id']);
//            return [$page];
//        }

        $fields = $info->getFieldSelection();

        $query = Page::query();

        foreach ($fields as $field => $keys) {
            if ($field === 'metatags') {
                $query->with('metatags');
            }
        }

        $page = $query->find($args['id']);
        return $page;
    }
}
