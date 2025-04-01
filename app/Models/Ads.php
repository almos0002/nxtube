<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    
    protected $fillable = [
        'id',
        'ads_banner_1',
        'ads_banner_2',
        'ads_popup',
        'ads_video',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
