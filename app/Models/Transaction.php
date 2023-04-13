<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const COMPLETE = 'complete';
    const INIT = 'init';
    const CANCELLED = 'cancelled';
    
	protected $fillable = [
		'user_id', 'product_id', 'status', 
        'amount', 'additional_id', 'off',
        'tracking_code'
	];

    public function scopeComplete($query)
    {
        return $query->where('status', self::COMPLETE);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
