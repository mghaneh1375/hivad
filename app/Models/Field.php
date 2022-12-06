<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    
    protected $fillable = [
        'is_required',
        'label',
        'type',
        'for',
        'visibility',
        'priority',
        'slug',
        'options'
    ];

    public function scopeVisible($query)
    {
        return $query->where('visibility', true);
    }

    public function scopeSurvey($query)
    {
        return $query->where('for', 'survey');
    }
    
    public function scopeAdvice($query)
    {
        return $query->where('for', 'advice');
    }

}
