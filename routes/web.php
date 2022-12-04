<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\Solicitacao_arquivoController;
use App\Http\Controllers\RelatorioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/admin/usuarios', [UserController::class, 'index'])->name('usuarios')->middleware('auth');
Route::get('/admin/usuarios/editar/{id}', [UserController::class, 'editar'])->name('usuarios_editar')->middleware('auth');
Route::put('/admin/usuarios/atualizar/{id}', [UserController::class, 'atualizar'])->name('usuarios_atualizar')->middleware('auth');
Route::delete('/admin/usuarios/deletar/{id}', [EventController::class, 'deletar'])->name('usuarios_deletar')->middleware('auth');

Route::get('/admin/departamentos', [DepartamentoController::class, 'index'])->name('departamentos');
Route::get('/admin/departamentos/adicionar', [DepartamentoController::class, 'adicionar'])->name('departamentos_adicionar')->middleware('auth');
Route::post('/admin/departamentos/adicionardepartamento', [DepartamentoController::class, 'adicionardepartamento'])->name('departamentos_adicionardp')->middleware('auth');
Route::get('/admin/departamentos/editar/{id}', [DepartamentoController::class, 'editar'])->name('departamentos_editar')->middleware('auth');
Route::put('/admin/departamentos/atualizar/{id}', [DepartamentoController::class, 'atualizar'])->name('departamentos_atualizar')->middleware('auth');
Route::delete('/admin/departamentos/deletar/{id}', [DepartamentoController::class, 'deletar'])->name('departamentos_deletar')->middleware('auth');
Route::get('/admin/departamentos/exportarexcel', [DepartamentoController::class, 'exportarExcel'])->middleware('auth');
Route::get('/admin/departamentos/exportarpdf', [DepartamentoController::class, 'exportarpdf'])->middleware('auth');

Route::get('/admin/arquivos', [ArquivoController::class, 'index'])->name('arquivos');
Route::get('/admin/arquivos/adicionar', [ArquivoController::class, 'adicionar'])->name('arquivos_adicionar')->middleware('auth');
Route::post('/admin/arquivos/adicionararquivo', [ArquivoController::class, 'adicionararquivo'])->name('arquivos_adicionaraq')->middleware('auth');
Route::get('/admin/arquivos/editar/{id}', [ArquivoController::class, 'editar'])->name('arquivos_editar')->middleware('auth');
Route::put('/admin/arquivos/atualizar/{id}', [ArquivoController::class, 'atualizar'])->name('arquivos_atualizar')->middleware('auth');
Route::delete('/admin/arquivos/deletar/{id}', [ArquivoController::class, 'deletar'])->name('arquivos_deletar')->middleware('auth');
Route::get('/admin/arquivos/exportarexcel', [ArquivoController::class, 'exportarExcel'])->middleware('auth');
Route::get('/admin/arquivos/exportarpdf', [ArquivoController::class, 'exportarpdf'])->middleware('auth');

Route::get('/documentos', [DocumentoController::class, 'index'])->name('documentos')->middleware('auth');
Route::get('/documentos/visualizar/{id}', [DocumentoController::class, 'visualizar'])->name('documentos_visualizar')->middleware('auth');

Route::get('/usuario/solicitacaoarquivos', [Solicitacao_arquivoController::class, 'index'])->name('solicitacao_arquivos_usuario')->middleware('auth');
Route::get('/usuario/solicitacaoarquivos/adicionar', [Solicitacao_arquivoController::class, 'adicionar'])->name('solicitacao_arquivos_usuario_adicionar')->middleware('auth');
Route::post('/usuario/solicitacaoarquivos/adicionarsolicitacao', [Solicitacao_arquivoController::class, 'adicionarsolicitacao'])->name('solicitacao_arquivos_usuario_adicionarsolicitacao')->middleware('auth');
Route::get('/usuario/solicitacaoarquivos/editar/{id}', [Solicitacao_arquivoController::class, 'editar'])->name('solicitacao_arquivos_usuario_editar')->middleware('auth');
Route::put('/usuario/solicitacaoarquivos/atualizar/{id}', [Solicitacao_arquivoController::class, 'atualizar'])->name('solicitacao_arquivos_usuario_atualizar')->middleware('auth');
Route::delete('/usuario/solicitacaoarquivos/deletar/{id}', [Solicitacao_arquivoController::class, 'deletar'])->name('solicitacao_arquivos_usuario_deletar')->middleware('auth');

Route::get('/admin/aprovacaoarquivos', [Solicitacao_arquivoController::class, 'aprovacaoarquivos'])->name('aprovacaoarquivos')->middleware('auth');
Route::get('/admin/aprovacaoarquivos/aprovarsolicitacao/{id}', [Solicitacao_arquivoController::class, 'aprovacaoarquivos_aprovar'])->name('aprovacaoarquivos_aprovar')->middleware('auth');
Route::get('/admin/aprovacaoarquivos/recusarsolicitacao/{id}', [Solicitacao_arquivoController::class, 'aprovacaoarquivos_recusar'])->name('aprovacaoarquivos_recusar')->middleware('auth');
Route::put('/admin/aprovacaoarquivos/aprovarsolicitacao/aprovar/{id}', [Solicitacao_arquivoController::class, 'aprovarsolicitacao'])->name('aprovarsolicitacao')->middleware('auth');
Route::put('/admin/aprovacaoarquivos/aprovarsolicitacao/recusar/{id}', [Solicitacao_arquivoController::class, 'recusarsolicitacao'])->name('recusarsolicitacao')->middleware('auth');

Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
