<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'day',
        'is_open',
        'start',
        'end'
    ];

    public function scopeOpen($query) {
        return $query->where('is_open', true);
    }

    public function peoples() {
        return $this->hasMany(PeopleWorkTime::class);
    }

}
