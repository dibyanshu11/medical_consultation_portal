<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatData extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'key',
        'audio',
        'chat_data',
        'status',
       

    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
