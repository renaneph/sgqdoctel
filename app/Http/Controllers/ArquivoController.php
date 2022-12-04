<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arquivo;
use App\Models\Departamento;
use App\Exports\ArquivosExport;
use Maatwebsite\Excel\Facades\Excel;

class ArquivoController extends Controller
{
    public function index(){

        $arquivos = Arquivo::all();
        $departamentos = Departamento::all();

        return view('sgqdoc/arquivos', ['arquivos' => $arquivos, 'departamentos' => $departamentos]);

    }

    public function editar($id){

        $arquivo = Arquivo::findOrFail($id);
        $departamentos = Departamento::all();

        return view('sgqdoc/arquivos_editar', ['arquivo' => $arquivo, 'departamentos' => $departamentos]);

    }

    public function atualizar(Request $request) {

        //$data = $request->all();

        //dd($request->all());

        $arquivo = Arquivo::findOrFail($request->id);
        $arquivo->nome_arquivo = $request->nome;
        $arquivo->versao = $request->versao;
        $arquivo->departamento = $request->departamento;

         // Arquivo Original Upload
         if($request->hasFile('arquivo_orig') && $request->file('arquivo_orig')->isValid()) {

            $requestImage = $request->arquivo_orig;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_originais'), $imageName);

            $arquivo->arquivo_original = $imageName;

        }

        // Arquivo Original Upload
        if($request->hasFile('arquivo_pdf') && $request->file('arquivo_pdf')->isValid()) {

            $requestImage = $request->arquivo_pdf;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_pdf'), $imageName);

            $arquivo->arquivo_pdf = $imageName;

        }

        $arquivo->data_modificacao = date_create(date('d-m-Y'));
        $arquivo->save();

        return redirect('/admin/arquivos');

    }

    public function deletar($id) {

        Arquivo::findOrFail($id)->delete();

        return redirect('/admin/arquivos');

    }

    public function adicionar(){

        $arquivos = Arquivo::all();
        $departamentos = Departamento::all();

        return view('sgqdoc/arquivos_adicionar', ['arquivos' => $arquivos, 'departamentos' => $departamentos]);

    }

    public function adicionararquivo(Request $request) {

        $arquivo = new Arquivo;

        $arquivo->nome_arquivo = $request->nome;
        $arquivo->versao = $request->versao;
        $arquivo->departamento = $request->departamento;

        // Arquivo Original Upload
        if($request->hasFile('arquivo_orig') && $request->file('arquivo_orig')->isValid()) {

            $requestImage = $request->arquivo_orig;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_originais'), $imageName);

            $arquivo->arquivo_original = $imageName;

        }

        // Arquivo Original Upload
        if($request->hasFile('arquivo_pdf') && $request->file('arquivo_pdf')->isValid()) {

            $requestImage = $request->arquivo_pdf;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('arquivos_pdf'), $imageName);

            $arquivo->arquivo_pdf = $imageName;

        }

        $arquivo->data_criacao = date_create(date('d-m-Y'));
        $arquivo->save();

        return redirect('/admin/arquivos');

    }
    
    public function exportarExcel() 
    {
        return Excel::download(new ArquivosExport, 'arquivos.xlsx');
    }

    public function exportarpdf()
    {
        $arquivos = Arquivo::all();
        $departamentos = Departamento::all();
    
        return \PDF::loadView('sgqdoc/arquivos', compact('arquivos','departamentos'))->setPaper('a4', 'landscape')->setOptions(['defaultFont' => 'sans-serif'])->download('arquivos.pdf');
    }

}
