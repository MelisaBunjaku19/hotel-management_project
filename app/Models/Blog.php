<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'excerpt'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

public function reviews()
{
    return $this->hasMany(Review::class);
}

}
