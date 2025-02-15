<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\VisibilityStatus;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'video_link', 'duration', 'description',
        'thumbnail', 'language', 'visibility'
    ];

    protected $casts = [
        'visibility' => VisibilityStatus::class
    ];

    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}