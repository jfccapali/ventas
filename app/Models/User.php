<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasRoles;

    public $timestamps=false;
    protected $table='usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [

    ];

    protected $hidden = [
        'remember_token',
    ];


    protected function casts(): array
    {
        return [

        ];
    }
}
