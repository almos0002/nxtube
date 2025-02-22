<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => ActiveStatus::class
    ];

    protected $withCount = ['videos'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'category_video');
    }
}