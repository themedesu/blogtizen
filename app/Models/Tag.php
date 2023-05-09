<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Visitable;
    protected $table = 'tags';
    protected $fillable = ['name', 'slug'];
    protected $appends = ['url'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getUrlAttribute()
    {
        return config('app.url') . '/tag/' . $this->slug;
    }

    /* Relations
     */

    public function tagArticles()
    {
        return $this->hasMany(TagArticle::class, 'tag_id', 'id');
    }
}
