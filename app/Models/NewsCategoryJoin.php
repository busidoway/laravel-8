<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategoryJoin extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'news_category_id',
    ];
}
