<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'people_id',
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
