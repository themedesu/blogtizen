<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagArticle extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tag_articles';
    protected $fillable = ['article_id', 'tag_id'];

    /* Relations
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
