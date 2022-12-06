<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFormField extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'field_id',
        'user_form_id',
        'answer'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
    
    public function userForm()
    {
        return $this->belongsTo(UserForm::class);
    }

}
