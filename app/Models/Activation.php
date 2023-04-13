<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    use HasFactory;
    protected $table = 'activation';
    public $timestamps = false;

    
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'password',
        'verification_code',
        'vc_expired_at'
    ];
}
