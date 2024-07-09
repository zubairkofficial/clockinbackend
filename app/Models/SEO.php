<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'keywords',
        'canonical',
        'og',
        'page_name',
        'schema_markup'
    ];
}
