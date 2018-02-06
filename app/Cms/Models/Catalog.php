<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalog extends Model 
{

    protected $table = 'catalogs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'catalog_id');
    }

}