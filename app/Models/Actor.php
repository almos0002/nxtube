<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\VisibilityStatus;
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
        'visibility' => VisibilityStatus::class,
        'type' => ActorType::class,
        'dob' => 'date'
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    // Get full name attribute
    public function getNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}