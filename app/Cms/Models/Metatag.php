<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Metatag extends Model
{
    protected $table = 'metatags';

    public $timestamps = false;

    protected $fillable = [
        'group',
        'group_title',
        'title',
        'name'
    ];
}
