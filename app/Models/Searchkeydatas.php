<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Searchkeydatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'searchkey',
        'chat',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
