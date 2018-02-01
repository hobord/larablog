<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ContentCategory extends Model 
{

    protected $table = 'content_categories';
    public $timestamps = false;
    protected $fillable = [
        'categorizable_type',
        'category_id',
        'content_id',
        'weight'
    ];

    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }

}