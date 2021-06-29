<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repo_Respostas extends Model
{
    protected $table = 'repo__respostas';

    public $timestamps = true;

    protected $fillable = [
        'resposta',
        'created_at',
        'updated_at',
    ];

    use HasFactory;
}
