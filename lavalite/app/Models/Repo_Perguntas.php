<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repo_Perguntas extends Model
{
    protected $table = 'repo__perguntas';

    public $timestamps = true;

    protected $fillable = [
        'pergunta',
        'created_at',
        'updated_at',
    ];

    use HasFactory;
}
