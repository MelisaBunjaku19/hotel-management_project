<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'rooms'; // Adjust if your table name is different

    // Define which attributes are mass assignable
    protected $fillable = [
        'room_title', 
        'description',
        'price',
        'wifi',
        'room_type', 
        'image',
        'is_booked',
    ];

    // Define the relationship between Room and Booking
  
}
