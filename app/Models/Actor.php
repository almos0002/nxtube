<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ActiveStatus;
use App\Enums\ActorType;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'stagename',
        'biography',
        'profile_image',
        'banner_image',
        'type',
        'dob',
        'language',
        'country',
        'specialties',
        'instagram',
        'facebook',
        'twitter',
        'website',
        'visibility'
    ];

    protected $casts = [
        'dob' => 'date',
        'visibility' => ActiveStatus::class,
        'type' => ActorType::class,
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function stats()
    {
        return $this->hasOne(ActorStats::class);
    }

    public function getViewsCountAttribute()
    {
        return $this->stats ? $this->stats->views_count : 0;
    }

    // Get full name attribute
    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}