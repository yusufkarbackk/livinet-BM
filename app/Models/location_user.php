<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location_user extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id'
    ];

    protected $table = 'location_users';
}
