<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short',
        'text',
        'date',
    ];

    public function viewpoint_person(){
        return $this->hasMany(ViewpointPerson::class);
    }
}
