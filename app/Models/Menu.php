<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'title',
        'url',
        'visible',
        'label'
    ];

    // public function parent()
    // {
    //     return $this->belongsTo(Menu::class, 'parent_id');
    // }

    // public function children()
    // {
    //     return $this->hasMany(Menu::class, 'parent_id');
    // }

    public $timestamps = false;

    public function scopeIsVisible($query)
    {
        return $query->where('visible', true);
    }

    public function scopeOfSort($query, $sort)
    {
        foreach ($sort as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }
}
