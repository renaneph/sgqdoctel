<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta_arquivos_departamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_departamento',
        'qtd_arquivos',
    ];
}
