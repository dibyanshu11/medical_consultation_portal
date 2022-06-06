<?php

namespace App\Enums;


enum UserRole:string
{
    case Admin = 'admin';
    case User = 'user';
    case Doctor = 'doctor';
    case Office = 'office';
}