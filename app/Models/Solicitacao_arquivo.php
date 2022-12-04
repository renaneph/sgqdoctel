<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao_arquivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_arquivo',
        'versao',
        'departamento',
        'arquivo_original',
        'arquivo_pdf',
        'data_criacao',
        'solicitante',
        'administrador',
        'comentario_administrador',
        'status',
    ];

    protected $dates = ['data_criacao', 'data_administrador'];
    
}
