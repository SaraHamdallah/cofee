<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
    'name' ,
    'email' ,
    'message',
    'seen',
    ];

    # Create an accessor for the formatted created_at
    public function getCreatedAtDiffForHumansAttribute()
    {
        $diff = $this->created_at->diffForHumans();
        $replacements = [
            ' seconds' => ' secs',
            ' second' => ' sec',
            ' minutes' => ' mins',
            ' minute' => ' min',
            ' hours' => ' hrs',
            ' hour' => ' hr',
            ' days' => ' days',
            ' day' => ' day',
            ' weeks' => ' weeks',
            ' week' => ' week',
            ' months' => ' months',
            ' month' => ' month',
            ' years' => ' yrs',
            ' year' => ' yr',
        ];
        
        return str_replace(array_keys($replacements), array_values($replacements), $diff);
    }
}
