<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pemilih extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pemilih';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
}
