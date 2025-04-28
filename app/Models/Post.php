<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    //
    use Searchable;
    protected $fillable = [
        'title',
        'description',
        'subreddit',
        'category_one',
        'category_two',
    ];
    public function searchableAs(): string {
        return 'posts_index';
    }
    public function toSearchableArray(): array {
        return array_merge($this->toArray(),[
            'id' => (string) $this->id,
            'created_at' => $this->created_at->timestamp,
            'title' => $this->title,
            'description' => $this->description,
            'subreddit' => $this->subreddit,
            'category_one' => $this->category_one,
        ]);
    }
    protected $with = ['user','comments','likes'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class)->orderByDesc('created_at');;
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function scopeMostRecent(Builder $query):Builder{
        return $query->orderByDesc('created_at');
  }
}
