<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_image', 'channel_name', 'handle', 'description',
        'banner', 'youtube', 'twitter', 'instagram', 'visibility'
    ];

    protected $casts = [
        'visibility' => VisibilityStatus::class
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}