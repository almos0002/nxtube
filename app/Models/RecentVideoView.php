<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentVideoView extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'video_id',
        'ip_address',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
