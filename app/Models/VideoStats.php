<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Video;

class VideoStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'views_count'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
