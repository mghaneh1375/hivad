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
 * @method static \Illuminate\Database\Query\Builder|\App\models\Article whereCategory($value)
 */

class Article extends Model {

    protected $table = 'articles';
    public $timestamps = false;

    public static function whereId($value) {
        return Article::find($value);
    }
}
