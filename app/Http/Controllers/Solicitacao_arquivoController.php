<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arquivo;
use App\Models\Departamento;
use App\Models\Solicitacao_arquivo;

class Solicitacao_arquivoController extends Controller
{
    public function index(){

        $user = auth()->user();
        #dd($user->id);
        $departamentos = Departamento::all();
        $arquivos_usuario = Solicitacao_arquivo::where('solicitante','=', $user->id)->get();
        #dd($arquivos_usuario);

        return view('sgqdoc/solicitacao_arquivos_usuario', ['arquivos_usuario' => $arquivos_usuario, 'departamentos' => $departamentos]);

    }

    public function editar($id){

        $arquivo_usuario = Solicitacao_arquivo::findOrFail($id);
        $departamentos = Departamento::all();

        return view('sgqdoc/solicitacao_arquivos_usuario_editar', ['arquivo_usuario' => $arquivo_usuario, 'departamentos' => $departamentos]);

    }

    public function atualizar(Request $request) {

        //$data = $request->all();

        //dd($request->all());

        $arquivo_usuario = Solicitacao_arquivo::findOrFail($request->id);
        $arquivo_usuario->nome_arquivo = $request->nome;
        $arquivo_usuario->versao = $request->versao;
        $arquivo_usuario->departamento = $request->departamento;

         // Arquivo Original Upload
         if($request->hasFile('arquivo_orig') && $request->file('arquivo_orig')->isValid()) {

            $requestImage = $request->arquivo_orig;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_originais'), $imageName);

            $arquivo_usuario->arquivo_original = $imageName;

        }

        // Arquivo Original Upload
        if($request->hasFile('arquivo_pdf') && $request->file('arquivo_pdf')->isValid()) {

            $requestImage = $request->arquivo_pdf;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_pdf'), $imageName);

            $arquivo_usuario->arquivo_pdf = $imageName;

        }

        $arquivo_usuario->save();

        return redirect('/usuario/solicitacaoarquivos');

    }

    public function deletar($id) {

        Solicitacao_arquivo::findOrFail($id)->delete();

        return redirect('/usuario/solicitacaoarquivos');

    }

    public function adicionar(){

        $arquivos = Arquivo::all();
        $departamentos = Departamento::all();

        return view('sgqdoc/solicitacao_arquivos_usuario_adicionar', ['arquivos' => $arquivos, 'departamentos' => $departamentos]);

    }

    public function adicionarsolicitacao(Request $request) {

        $user = auth()->user();
        $arquivo_usuario = new Solicitacao_arquivo;

        $arquivo_usuario->nome_arquivo = $request->nome;
        $arquivo_usuario->versao = $request->versao;
        $arquivo_usuario->departamento = $request->departamento;

        // Arquivo Original Upload
        if($request->hasFile('arquivo_orig') && $request->file('arquivo_orig')->isValid()) {

            $requestImage = $request->arquivo_orig;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_originais'), $imageName);

            $arquivo_usuario->arquivo_original = $imageName;

        }

        // Arquivo Original Upload
        if($request->hasFile('arquivo_pdf') && $request->file('arquivo_pdf')->isValid()) {

            $requestImage = $request->arquivo_pdf;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_pdf'), $imageName);

            $arquivo_usuario->arquivo_pdf = $imageName;

        }

        $arquivo_usuario->data_criacao = date_create(date('d-m-Y'));
        $arquivo_usuario->solicitante = $user->id;
        $arquivo_usuario->status = 'Pendente';
        $arquivo_usuario->save();

        return redirect('/usuario/solicitacaoarquivos');

    }

    public function aprovacaoarquivos(){

        $departamentos = Departamento::all();
        $arquivos_usuario = Solicitacao_arquivo::where('status','=', 'Pendente')->get();
        #dd($arquivos_usuario);

        return view('sgqdoc/aprovacao_arquivos', ['arquivos_usuario' => $arquivos_usuario, 'departamentos' => $departamentos]);

    }

    public function aprovacaoarquivos_aprovar($id){

        $departamentos = Departamento::all();
        $arquivo_usuario = Solicitacao_arquivo::findOrFail($id);
        #$arquivo_usuario = Solicitacao_arquivo::where('id','=', $id)->get();
        #dd($arquivo_usuario);

        return view('sgqdoc/aprovacao_arquivos_aprovar', ['arquivo_usuario' => $arquivo_usuario, 'departamentos' => $departamentos]);

    }

    public function aprovacaoarquivos_recusar($id){

        $departamentos = Departamento::all();
        $arquivo_usuario = Solicitacao_arquivo::findOrFail($id);
        #$arquivo_usuario = Solicitacao_arquivo::where('id','=', $id)->get();
        #dd($arquivos_usuario);

        return view('sgqdoc/aprovacao_arquivos_recusar', ['arquivo_usuario' => $arquivo_usuario, 'departamentos' => $departamentos]);

    }

    public function aprovarsolicitacao($id, Request $request){

        $usuario = auth()->user();
        $departamentos = Departamento::all();

        $arquivo_usuario = Solicitacao_arquivo::findOrFail($id);
        $arquivo_usuario->administrador = $usuario->id;
        $arquivo_usuario->comentario_administrador = $request->comentario_administrador;
        $arquivo_usuario->data_administrador = date_create(date('d-m-Y'));
        $arquivo_usuario->status = 'Aprovado';
        $arquivo_usuario->save();

        $arquivo = new Arquivo;

        $arquivo->nome_arquivo = $arquivo_usuario->nome_arquivo;
        $arquivo->versao = $arquivo_usuario->versao;
        $arquivo->departamento = $arquivo_usuario->departamento;
        $arquivo->arquivo_original = $arquivo_usuario->arquivo_original;
        $arquivo->arquivo_pdf = $arquivo_usuario->arquivo_pdf;
        $arquivo->data_criacao = date_create(date('d-m-Y'));
        $arquivo->save();

        #$arquivo_usuario = Solicitacao_arquivo::where('id','=', $id)->get();
        #dd($arquivo_usuario);

        return redirect('/admin/aprovacaoarquivos');

    }

    public function recusarsolicitacao($id, Request $request){

        $usuario = auth()->user();
        $departamentos = Departamento::all();
        $arquivo_usuario = Solicitacao_arquivo::findOrFail($id);
        $arquivo_usuario->administrador = $usuario->id;
        $arquivo_usuario->comentario_administrador = $request->comentario_administrador;
        $arquivo_usuario->data_administrador = date_create(date('d-m-Y'));
        $arquivo_usuario->status = 'Recusado';
        $arquivo_usuario->save();
        #$arquivo_usuario = Solicitacao_arquivo::where('id','=', $id)->get();
        #dd($arquivos_usuario);

        return redirect('/admin/aprovacaoarquivos');

    }
}
