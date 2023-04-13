<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'SlideBar'
 *
 * @property integer $id
 * @property string $image
 * @property string|null $header
 * @property string|null $description
 * @property integer $priority
 * @property boolean $visibility
 * @property string|null $alt
 */

class SlideBar extends Model
{
    public $table = 'slide_bar';
    public $timestamps = false;
    
    protected $fillable = [
        'image',
        'alt',
        'priority',
        'visibility',
        'header',
        'description'
    ];


    public static function whereId($value) {
        return SlideBar::find($value);
    }

    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
}
