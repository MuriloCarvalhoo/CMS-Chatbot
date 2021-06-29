<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulacaoEmprestimo extends Model
{
    protected $table = 'simulacao_emprestimo';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'Cpf',
        'email',
        'celular_com_ddd',
        'ip_address',
        'created_at',
        'updated_at',
    ];


    use HasFactory;

}
