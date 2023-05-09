<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use StringText;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Visitable;
    protected $table = 'articles';
    protected $fillable = ['title', 'slug', 'content', 'description', 'thumbnail', 'thumbnail_credit', 'hits', 'author_id'];
    protected $appends = ['url', 'thumbnail_url', 'title_slice', 'content_slice'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getTitleSliceAttribute()
    {
        return StringText::limit($this->title ? $this->title : '', 55);
    }

    public function getContentSliceAttribute()
    {
        return StringText::limit($this->content ? $this->content : '', 160);
    }

    public function getUrlAttribute()
    {
        return config('app.url') . '/article/' . $this->slug;
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return config('app.url') . '/assets/image/no-thumbnail.jpg';
        }

        return config('app.url') . '/storage/' . $this->thumbnail;
    }

    public function incrementHitsCount()
    {
        $this->hits++;
        return $this->save();
    }

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->setTimezone(config('app.timezone'))->format('d-m-Y H:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return (new Carbon($value))->setTimezone(config('app.timezone'))->format('d-m-Y H:i');
    }

    /* Relations
     */

    public function tagArticles()
    {
        return $this->hasMany(TagArticle::class, 'article_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
