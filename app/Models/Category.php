<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['kind', 'max_size', 'max_age', 'growth_factor'];

    protected $table = 'categories';

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
