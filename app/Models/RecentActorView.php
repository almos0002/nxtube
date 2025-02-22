<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentActorView extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'actor_id',
        'ip_address',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }
}
