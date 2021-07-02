<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HtmlModel extends Model
{
    protected $table = 'html';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'html',
    ];


    use HasFactory;
}
