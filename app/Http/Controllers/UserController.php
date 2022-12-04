<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){

        $usuarios = User::all();

        return view('sgqdoc/usuarios', ['usuarios' => $usuarios]);

    }

    public function editar($id){

        $usuario = User::findOrFail($id);

        return view('sgqdoc/usuarios_editar', ['usuario' => $usuario]);

    }

    public function atualizar(Request $request) {

        //$data = $request->all();

        //dd($request->all());

        $usuario = User::findOrFail($request->id);
        $usuario->name = $request->nome;
        $usuario->email = $request->email;
        $usuario->perfil = $request->perfil;
        $usuario->save();

        return redirect('/admin/usuarios');

    }

    public function deletar($id) {

        User::findOrFail($id)->delete();

        return redirect('/admin/usuarios');

    }
}
