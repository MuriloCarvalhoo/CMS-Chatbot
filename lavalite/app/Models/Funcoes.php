<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcoes extends Model
{
    protected $table = 'funcoes';

    public $timestamps = true;

    protected $fillable = [
        'tipo',
        'nome',
        'func_1',
        'nome_func',
        'func_2',
        'func_3',
        'func_4',
        'nome_prox',
        'func_5',
    ];

    use HasFactory;
}
