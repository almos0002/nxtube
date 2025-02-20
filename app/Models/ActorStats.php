<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorStats extends Model
{
    protected $fillable = [
        'actor_id',
        'views_count'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }
}
