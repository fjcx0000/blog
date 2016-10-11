<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', ];

    public function Tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag', 'article_id', 'tag_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}