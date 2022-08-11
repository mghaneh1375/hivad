<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'Gallery'
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property integer $category
 * @method static \Illuminate\Database\Query\Builder|\App\models\Gallery whereCategory($value)
 */

class Gallery extends Model {

    protected $table = 'gallery';
    public $timestamps = false;

    public static function whereId($value) {
        return Gallery::find($value);
    }

    public function scopeImp($query)
    {
        return $query->where('is_imp', true)->where('visibility', true);
    }
}
