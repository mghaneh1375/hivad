<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'video';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'file',
        'alt',
        'priority',
        'visibility',
        'title',
        'is_imp',
        'cat_id'
    ];

    public static function whereId($value)
    {
        return Video::find($value);
    }

    public function scopeImp($query)
    {
        return $query->where('is_imp', true)->where('visibility', true);
    }
}
