<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\VisibilityStatus;
use App\ActorType;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_image', 'firstname', 'lastname', 'stagename', 'biography',
        'banner_image', 'type', 'dob', 'language', 'country', 'specialties',
        'instagram', 'facebook', 'twitter', 'website', 'visibility'
    ];

    protected $casts = [
        'dob' => 'date',
        'type' => ActorType::class,
        'visibility' => VisibilityStatus::class
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}