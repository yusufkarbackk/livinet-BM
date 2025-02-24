<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TenantData extends Model
{
    use HasFactory;

    protected $fillable = [
        'clientid',
        'firstname', 
        'lastname', 
        'serviceid', 
        'name', 
        'amount', 
        'location',
        'status',
        'locationId',
        'termination_date',
    ];

    public $timestamps = true;

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    protected $table = "tenant_data";
    protected $casts = [
        'termination_date' => 'string',
    ];
}
