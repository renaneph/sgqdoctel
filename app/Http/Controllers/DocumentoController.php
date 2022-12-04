<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arquivo;
use App\Models\Departamento;
use App\Models\Visualizacao_documento;

class DocumentoController extends Controller
{
    public function index(){

        $arquivos = Arquivo::all();
        $departamentos = Departamento::all();

        return view('sgqdoc/documentos', ['arquivos' => $arquivos, 'departamentos' => $departamentos]);

    }

    public function visualizar($id){

        $arquivo = Arquivo::findOrFail($id);
        $visualizacao = Visualizacao_documento::where('id_arquivo','=',$id)->first();
        #dd($visualizacao);

        if($visualizacao == null){

            $visualizacao_arquivo = new Visualizacao_documento;
    
            $visualizacao_arquivo->nome_arquivo = $arquivo->nome_arquivo;
            $visualizacao_arquivo->id_arquivo = $arquivo->id;
            $visualizacao_arquivo->qtd_visualizacao = 1;
            $visualizacao_arquivo->save();
        } else {
            $visualizacao->qtd_visualizacao = $visualizacao->qtd_visualizacao + 1;
            $visualizacao->save();
    
            }

        return redirect('/arquivos_pdf/'.$arquivo->arquivo_pdf);

    }
}
