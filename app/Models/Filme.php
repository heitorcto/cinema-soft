<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'filmes';

    protected $fillable = [
        'nome',
        'inicio_sessao',
        'final_sessao',
        'sala_id'
    ];
}
