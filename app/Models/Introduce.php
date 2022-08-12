<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    use HasFactory;
    
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
