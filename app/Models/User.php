<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_video(){
        return $this->hasMany(UserVideo::class);
    }

    public function user_role(){
        return $this->hasMany(UserRole::class);
    }

    public function isAdmin(){
        $role = DB::table('roles')
                    ->select('roles.level')
                    ->join('user_roles', 'roles.id', '=', 'user_roles.role_id')
                    ->where('user_roles.user_id', $this->id)
                    ->value('roles.level');

        return $role === 1;
    }
}
