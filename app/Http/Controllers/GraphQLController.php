<?php
/**
 * Created by PhpStorm.
 * User: balazss
 * Date: 2/21/2018
 * Time: 9:31 AM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class GraphQLController extends \Folklore\GraphQL\GraphQLController
{
    protected function executeQuery($schema, $input)
    {
        $minutes = env('CACHE_TTL', 60);
        $hash = serialize($input);
        $key = 'GraphQL' . Hash::make($hash);

        $user_tag = 'user_' . (Auth::check()) ? Auth::id() : 0;

        $result = Cache::tags(['graphql', $user_tag])->remember($key, $minutes, function () use ($schema, $input) {
            return parent::executeQuery($schema, $input);
        });

        return $result;
    }
}