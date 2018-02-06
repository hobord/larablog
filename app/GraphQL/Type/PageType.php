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
            'categories' => [
                'type' => Type::listOf(GraphQL::type('CategoryType')),
                'description' => 'The user posts',
            ],
            'metatags' => [
                'type' => Type::listOf(GraphQL::type('ContentMetatagType')),
                'description' => 'The user posts',
            ],
            'editor' => [
                'type' => GraphQL::type('UserType'),
                'description' => 'The editor or this page',
            ]
        ];
    }
}
