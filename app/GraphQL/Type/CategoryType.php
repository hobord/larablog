<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class CategoryType extends BaseType
{
    protected $attributes = [
        'name' => 'CategoryType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::ID()],
            'catalog_id' => ['name' => 'catalog_id', 'type' => Type::ID()],
            'catalog' => ['name' => 'catalog', 'type' => GraphQL::type('CatalogType')],
            'parent_id' => ['name' => 'parent_id', 'type' => Type::ID()],
            'parent' => ['name' => 'parent', 'type' => GraphQL::type('CategoryType')],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'weight' => ['name' => 'weight', 'type' => Type::int()],
            'created_at' => ['name' => 'created_at', 'type' => Type::string()],
            'updated_at' => ['name' => 'updated_at', 'type' => Type::string()],
        ];
    }
}
