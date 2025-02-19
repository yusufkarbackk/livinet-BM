<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class location extends Model
{
    use HasFactory;

    protected $fillable = [
        "location"
    ];

    public function users() : BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
