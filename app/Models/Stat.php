<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;
    protected $fillable = [
        'total_task',
        'task_completed',
        'remaining_task',
        'content',
        'heading'
    ];
}
