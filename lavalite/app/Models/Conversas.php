<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversas extends Model
{
    protected $table = 'conversas';

    public $timestamps = true;

    protected $fillable = [
        'nome_conversa',
        'ordem',
        'nome_func',
        'parte_1',
        'pergunta',
        'parte_2',
        'resposta',
        'parte_3',
        'nome_prox',
        'parte_4',
        'created_at',
        'updated_at',
    ];

    use HasFactory;
}
