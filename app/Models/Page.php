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

class Page extends Model
{
    use HasFactory, SoftDeletes, HasSlug, Visitable;
    protected $table = 'pages';
    protected $fillable = ['title', 'slug', 'content', 'description', 'hits', 'author_id'];
    protected $appends = ['url', 'title_slice', 'content_slice'];

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
        return StringText::limit($this->content ? $this->content : '', 170);
    }

    public function getUrlAttribute()
    {
        return config('app.url') . '/page/' . $this->slug;
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

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
