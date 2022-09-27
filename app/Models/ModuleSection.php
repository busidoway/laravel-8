<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSection extends Model
{
    use HasFactory;

    public function page(){
        return $this->belongsTo(Page::class);
    }

    public function text_block(){
        return $this->hasMany(TextBlock::class);
    }
}
