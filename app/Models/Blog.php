<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'thumbnail'];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
    
}

public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
{
    return $this->belongsToMany(Tag::class, 'blog_tag');
}

}

