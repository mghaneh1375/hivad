<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'News'
 *
 * @property integer $id
 * @property string|null $description
 * @property string $image
 * @property string|null $alt
 * @property string $title
 * @property string $digest
 * @property string|null $tags
 * @property boolean $is_imp
 * @property integer $priority
 * @property boolean $visibility
 */

class News extends Model {

    protected $table = 'news';
    
    protected $fillable = [
        'image',
        'tags',
        'priority',
        'visibility',
        'title',
        'is_imp',
        'digest',
        'description',
        'keywords',
        'alt',
    ];

    public static function whereId($value) {
        return News::find($value);
    }
    
    public function scopeImp($query)
    {
        return $query->where('is_imp', true)->where('visibility', true);
    }
    
    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
}
