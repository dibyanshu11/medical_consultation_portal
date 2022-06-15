<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class USState extends Model
{
    use HasFactory;

    protected $table = "us_states";

    protected $fillable = [
        'name', 'code'
    ];
}
