<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\VisibilityStatus;
use App\Models\Video;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_image', 'channel_name', 'handle', 'description',
        'banner_image', 'youtube', 'twitter', 'instagram', 'visibility'
    ];

    protected $casts = [
        'visibility' => VisibilityStatus::class
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }
}