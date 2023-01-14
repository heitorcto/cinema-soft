<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Administrador extends User
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'administradores';

    protected $fillable = [
        'nome',
        'email',
        'nascimento',
        'criado_em',
        'atualizado_em'
    ];

    protected $hidden = [
        'senha'
    ];
}
