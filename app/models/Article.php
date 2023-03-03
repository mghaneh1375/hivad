<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Article'
 *
 * @property integer $id
 * @property string|null $description
 * @property string|null $file
 * @property string|null $img
 * @property string $title
 * @property integer $category
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereCategory($value)
 */

class Article extends Model {

    protected $table = 'article';

    protected $fillable = [
        'image',
        'alt_image',
        'priority',
        'visibility',
        'title',
        'file',
        'tags',
        'price',
        'digest',
        'keywords',
        'is_imp',
        'description',
        'category_id'
    ];

    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }
    
    public function scopeImp($query)
    {
        return $query->where('is_imp', true);
    }

}
