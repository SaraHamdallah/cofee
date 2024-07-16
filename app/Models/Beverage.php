<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'price',
        'published',
        'special',
        'image',
        'category_id',
        
    ];

    #this line to make relation one to many
public function category()  // Corrected to singular since it's belongsTo relationship
{
    return $this->belongsTo(Category::class, 'category_id');
}
}
