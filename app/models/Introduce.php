<?php

namespace App\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'alt',
        'priority'
    ];

    protected $table = 'introduce';
    public $timestamps = false;

    public static function whereId($value) {
        return Introduce::find($value);
    }

    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
}
