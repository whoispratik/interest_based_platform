<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'description',
        'user_id'
    ];
    protected $with = ['user'];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeMostRecent(Builder $query):Builder{
        return $query->orderByDesc('created_at');
  }
}
