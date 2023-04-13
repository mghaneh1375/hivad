<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'alt',
        'priority'
    ];

    protected $table = 'cafe';
    public $timestamps = false;

    public static function whereId($value) {
        return Cafe::find($value);
    }

    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
}
