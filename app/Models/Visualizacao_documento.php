<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visualizacao_documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_arquivo',
        'id_arquivo',
        'qtd_visualizacao',
    ];
}
