<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ContentMetatag extends Model
{
    protected $table = 'content_metatags';

    protected $fillable = [
        'metatag_id',
        'content_id',
        'content_model',
        'value'
    ];

    public function metatag()
    {
        return $this->belongsTo(Metatag::class, 'metatag_id', 'id');
    }
}
