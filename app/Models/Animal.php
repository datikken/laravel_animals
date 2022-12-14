<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'size', 'category_id'];

    protected $table = 'animals';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
