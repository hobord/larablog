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
            'editor_id' => ['name' => 'editor_id', 'type' => Type::ID()],
            'categories_id' => ['name' => 'categories_id', 'type' => Type::listOf(Type::ID())], // And where
            'tags_id' => ['name' => 'tags_id', 'type' => Type::listOf(Type::ID())], // Where in
            'title' => ['name' => 'title', 'type' => Type::string()], // Like search
            'status' => ['name' => 'status', 'type' => Type::string()],
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
        $eloquentPageRepository = new EloquentPageRepository(new Page());

        $fields = $info->getFieldSelection();

        return $eloquentPageRepository->paginatedQuery($args, $fields);
    }
}
