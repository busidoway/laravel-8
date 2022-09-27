<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReestrOrg extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_org',
        'num_cert',
        'city',
        'region',
        'date_start',
        'date_end',
        'manager',
        'website',
        'phone',
        'address',
        'email',
        'boss',
        'program'
    ];
}
