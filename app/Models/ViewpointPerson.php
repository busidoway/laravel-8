<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewpointPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewpoint_id',
        'people_id',
    ];

    public function viewpoint(){
        return $this->belongsTo(Viewpoint::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
