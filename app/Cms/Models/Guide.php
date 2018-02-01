<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
class Guide extends Model
{

    protected $table = 'guides';
    public $timestamps = true;

    use SoftDeletes;
    use HasMediaTrait;

    protected $dates = ['deleted_at', 'publish_at', 'hide_at'];

    protected $fillable = [
        'title',
        'body',
        'status',
        'publish_at',
        'hide_at'
    ];

    protected $hidden = [
        'editor_id'
    ];

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'category');
    }

    public function chapters()
    {
        return $this->hasMany(GuideChapter::class, 'guide_id');
    }
}