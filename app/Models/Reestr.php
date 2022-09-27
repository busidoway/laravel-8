<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reestr extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_doc',
        'name',
        'city',
        'region',
        'date_start',
        'date_end',
        'date_doc',
        'organization',
        'url',
        'url_value',
    ];
}
