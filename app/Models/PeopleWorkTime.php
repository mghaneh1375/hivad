<?php

namespace App\Models;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleWorkTime extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = [
        'priority',
        'people_id',
        'schedule_id',
        'start',
        'end'
    ];

    public function people() {
        return $this->belongsTo(People::class);
    }
    
    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }

}
