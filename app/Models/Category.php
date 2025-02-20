<?php

namespace App\Models;

use App\Enums\ActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    protected $casts = [
        'status' => ActiveStatus::class
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'category_video');
    }
}