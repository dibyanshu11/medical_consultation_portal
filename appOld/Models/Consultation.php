<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_id',
        'doctor_id',
        'response_name',
        'keywords',
        'questions',
         'phrases',
        'video_link',
        'video_response',
      
    ];

    public function office()
    {
        return $this->belongsTo(Office::class,'office_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
