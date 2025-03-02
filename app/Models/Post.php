<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'subreddit',
        'category_one',
        'category_two',
    ];
    protected $with = ['user','comments'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class)->orderByDesc('created_at');;
    }
    public function scopeMostRecent(Builder $query):Builder{
        return $query->orderByDesc('created_at');
  }
}
