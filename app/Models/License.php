<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        'purchase_code', 'buyer_username', 'item_id', 
        'item_name', 'domain', 'supported_until', 'is_active'
    ];

    protected $casts = [
        'supported_until' => 'datetime',
        'is_active' => 'boolean',
    ];
}
