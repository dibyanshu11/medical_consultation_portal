<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'office_name',
        'address',
        'city',
        'state',
        'zip_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
