<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Metatag extends Model
{
    protected $table = 'metatags';

    protected $fillable = [
        'group',
        'name'
    ];
}
