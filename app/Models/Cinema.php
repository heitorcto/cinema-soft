<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cinemas';

    protected $fillable = [
        'estado',
        'cidade',
        'criado_em'
    ];
}
