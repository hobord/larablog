<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class CatalogType extends BaseType
{
    protected $attributes = [
        'name' => 'CatalogType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::ID()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'type' => ['name' => 'type', 'type' => Type::string()],
            'categories' => ['name' => 'categories', 'type' => Type::listOf(GraphQL::type('CategoryType'))],
            'created_at' => ['name' => 'created_at', 'type' => Type::string()],
            'updated_at' => ['name' => 'updated_at', 'type' => Type::string()],
        ];
    }
}
