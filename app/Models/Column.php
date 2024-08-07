<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    protected $fillable = ['row_id', 'data'];
    public function row(){
        return $this->belongsTo(Row::class);
    }
}
