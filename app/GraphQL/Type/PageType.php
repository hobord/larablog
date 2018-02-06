<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class PageType extends BaseType
{
    protected $attributes = [
        'name' => 'PageType',
        'description' => 'Page type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The page id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => "The page's title"
            ],
            'body' => [
                'type' => Type::string(),
                'description' => "The page's body"
            ],
            'status' => [
                'type' => Type::string(),
                'description' => "The page's status"
            ],
            'categories' => [
                'type' => Type::listOf(GraphQL::type('CategoryType')),
                'description' => 'Categories',
            ],
            'metatags' => [
                'type' => Type::listOf(GraphQL::type('ContentMetatagType')),
                'description' => 'Metatags',
            ],
            'editor_id' => [
                'type' => Type::id(),
                'description' => 'The editor or this page',
            ],
            'editor' => [
                'type' => GraphQL::type('UserType'),
                'description' => 'The editor or this page',
            ]
        ];
    }
}
