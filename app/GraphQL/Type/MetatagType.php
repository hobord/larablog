<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class MetatagType extends BaseType
{
    protected $attributes = [
        'name' => 'MetatagType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'title' => ['name' => 'title', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'group' => ['name' => 'group', 'type' => Type::string()],
            'group_title' => ['name' => 'group_title', 'type' => Type::string()],
        ];
    }
}
