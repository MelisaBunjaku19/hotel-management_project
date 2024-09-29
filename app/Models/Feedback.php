<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Specify the fields that can be mass-assigned
    protected $fillable = ['name', 'email', 'message'];

    // Optionally, you can define any relationships or accessors if needed
    // For example, if there's a relationship to a user model:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
