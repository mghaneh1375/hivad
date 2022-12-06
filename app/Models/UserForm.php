<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'for',
        'ip'
    ];

    public function scopeUnSeen($query)
    {
        return $query->where('seen', false);
    }

    public function scopeSurvey($query)
    {
        return $query->where('for', 'survey');
    }
    
    public function scopeAdvice($query)
    {
        return $query->where('for', 'advice');
    }

    public function fields() {
        return $this->hasMany(UserFormField::class);
    }


}
