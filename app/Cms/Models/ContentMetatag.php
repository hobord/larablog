<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ContentMetatag extends Model
{
    protected $table = 'content_metatags';

    protected $fillable = [
        'metatag_id',
        'content_id',
        'content_type',
        'value'
    ];

    public function metatag()
    {
        return $this->belongsTo(Metatag::class, 'metatag_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->metatag->name;
    }

    public function getTitleAttribute()
    {
        return $this->metatag->title;
    }

    public function getGroupAttribute()
    {
        return $this->metatag->group;
    }

    public function getGroupTitleAttribute()
    {
        return $this->metatag->group_title;
    }
}
