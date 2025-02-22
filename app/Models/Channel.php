<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ActiveStatus;
use App\Models\Video;
use Cviebrock\EloquentSluggable\Sluggable;

class Channel extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'profile_image', 'channel_name', 'handle', 'description',
        'banner_image', 'youtube', 'twitter', 'instagram', 'visibility', 'slug'
    ];

    protected $casts = [
        'visibility' => ActiveStatus::class
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'channel_name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function getViewsCountAttribute()
    {
        return $this->videos()
            ->join('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->sum('video_stats.views_count');
    }
}