<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model 
{

    protected $table = 'menus';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');
    protected $hidden = array('type');

    public function menu_items()
    {
        return $this->hasMany('MenuItem', 'parent_id');
    }

}