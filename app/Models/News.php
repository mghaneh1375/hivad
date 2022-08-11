<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'News'
 *
 * @property integer $id
 * @property string|null $description
 * @property string|null $img
 * @property string $title
 * @property integer $category
 * @method static \Illuminate\Database\Query\Builder|\App\models\News whereCategory($value)
 */

class News extends Model {

    protected $table = 'news';

    public static function whereId($value) {
        return News::find($value);
    }
}
