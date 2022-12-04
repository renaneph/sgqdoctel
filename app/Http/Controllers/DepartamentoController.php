<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Exports\DepartamentosExport;
use Maatwebsite\Excel\Facades\Excel;

class DepartamentoController extends Controller
{
    public function index(){

        $departamentos = Departamento::all();

        return view('sgqdoc/departamentos', ['departamentos' => $departamentos]);

    }

    public function editar($id){

        $departamento = Departamento::findOrFail($id);

        return view('sgqdoc/departamentos_editar', ['departamento' => $departamento]);

    }

    public function atualizar(Request $request) {

        //$data = $request->all();

        //dd($request->all());

        $departamento = Departamento::findOrFail($request->id);
        $departamento->nome = $request->nome;
        $departamento->data_criacao = date_create(date('d-m-Y'));
        $departamento->save();

        return redirect('/admin/departamentos');

    }

    public function deletar($id) {

        Departamento::findOrFail($id)->delete();

        return redirect('/admin/departamentos');

    }

    public function adicionar(){

        $departamentos = Departamento::all();

        return view('sgqdoc/departamentos_adicionar', ['departamentos' => $departamentos]);

    }

    public function adicionardepartamento(Request $request) {

        $departamento = new Departamento;

        $departamento->nome = $request->nome;
        $departamento->data_criacao = date_create(date('d-m-Y'));
        $departamento->save();

        return redirect('/admin/departamentos');

    }

    public function exportarExcel() 
    {
        return Excel::download(new DepartamentosExport, 'departamentos.xlsx');
    }

    public function exportarpdf()
    {
        $departamentos = Departamento::all();
    
        return \PDF::loadView('sgqdoc/departamentos', compact('departamentos'))->setPaper('a4', 'landscape')->setOptions(['defaultFont' => 'sans-serif'])->download('departamentos.pdf');
    }

}
