<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdviceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'people_work_time_id',
        'date',
        'description'
    ];

    public function scopeUnSeen($query)
    {
        return $query->where('seen', false);
    }
    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }
    
    public function people_work_time()
    {
        return $this->belongsTo(PeopleWorkTime::class);
    }


}
