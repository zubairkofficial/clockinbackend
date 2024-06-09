<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_logo',
        'review',
        'user_image',
        'user_name'
    ];
}
