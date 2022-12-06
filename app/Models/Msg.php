<?php

namespace App\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;
    
    protected $table = 'msg';

    protected $fillable = [
        'name',
        'mail',
        'phone',
        'id',
        'seen',
        'title',
        'msg',
    ];

    public function scopeUnSeen($query) {
        return $query->where('seen', false);
    }
}
