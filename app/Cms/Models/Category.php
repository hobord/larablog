<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'parent_id',
        'catalog_id',
        'name',
        'weight'
    ];

    public function catalog()
    {
        return $this->belongsTo('Catalog', 'catalog_id');
    }

    public function parent()
    {
        return $this->hasOne('Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Category', 'parent_id');
    }

    public function contents()
    {
        return $this->morphedByMany('App\Cms\Content', 'category');
    }

}