<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriarClasse extends Model
{
    protected $table = 'classe';

    public $timestamps = true;

    protected $fillable = [
        'parte_1',
        'nome_classe',
        'parte_2',
        'conversa_ordem',
        'final',
    ];

    use HasFactory;
}
