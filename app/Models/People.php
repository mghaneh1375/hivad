<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'alt',
        'priority',
        'bio',
        'name'
    ];

    protected $table = 'people';
    public $timestamps = false;

    public static function whereId($value) {
        return People::find($value);
    }

    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
}
