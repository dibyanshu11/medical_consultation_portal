<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_id',
        'office_name',
        'first_name',
        'last_name',
        'full_name',
        'doctor_pic',
        'practice',
        'description',
        'intro_video',

    ];

    public function getDoctorPicAttribute($value) {
        
        return env('APP_URL').'/storage/doctor-profile/'.$value;
    }



    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function consultation()
    {
        return $this->hasMany(Consultation::class);
    }
}
