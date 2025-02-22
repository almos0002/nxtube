<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VisibilityStatus;
use Cviebrock\EloquentSluggable\Sluggable;

class Video extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'video_link',
        'duration',
        'description',
        'thumbnail',
        'language',
        'visibility'
    ];

    protected $casts = [
        'visibility' => VisibilityStatus::class
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_video');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function videoStats()
    {
        return $this->hasOne(VideoStats::class);
    }
}