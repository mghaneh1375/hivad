<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'file',
        'keywords',
        'priority',
        'visibility',
        'title',
        'is_imp',
        'digest',
        'description',
        'price',
        'alt',
    ];


    public function scopeImp($query)
    {
        return $query->where('is_imp', true)->where('visibility', true);
    }
    
    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
}
