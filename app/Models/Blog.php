<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use HasFactory, Searchable;

    // Fillable attributes
    protected $fillable = ['title', 'content', 'image', 'excerpt', 'category_id', 'user_id', 'views'];

    // Relationship with comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship with likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Relationship with reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with user (author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with tags (many-to-many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Customize the data array to be indexed by Algolia.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'title' => $this->title,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'views' => $this->views,
            // Include any other attributes you want to be searchable
        ];
    
        \Log::info('Searchable Array:', $array); // Log the array for debugging
    
        return $array;
    }
    
}
