<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;
    protected $fillable = ['page_id'];

    public function page(){
        return $this->belognsTo(Page::class);
    }
    public function columns(){
        return $this->hasMany(Column::class);
    }
}
