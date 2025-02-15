<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'video_link', 'duration', 'description',
        'thumbnail', 'channel_id', 'category_id', 'language',
        'actor_id', 'visibility'
    ];

    protected $casts = [
        'visibility' => VisibilityStatus::class
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}