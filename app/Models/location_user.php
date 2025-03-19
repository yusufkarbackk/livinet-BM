<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location_user extends Model
{
    use HasFactory;

    protected $fillable = [
        "location",
        "string_reference"
    ];
}
