<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model 
{

    protected $table = 'menu_items';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('parent_id', 'menu_id', 'title');

    public function menu()
    {
        return $this->belongsTo('Menu', 'menu_id');
    }

    public function parent()
    {
        return $this->hasOne('MenuItem', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('MenuItem', 'parent_id');
    }

}