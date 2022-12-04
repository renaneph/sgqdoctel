<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_arquivo',
        'versao',
        'departamento',
        'arquivo_original',
        'arquivo_pdf',
        'data_criacao',
    ];

    protected $dates = ['data_criacao'];
}
