<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lector',
        'org',
        'time',
        'date',
        'cat',
        'url',
        'image'
    ];

    public function user_video(){
        return $this->hasMany(UserVideo::class);
    }
}
